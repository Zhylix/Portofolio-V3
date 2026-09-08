import Alpine from 'alpinejs';
import gsap from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

gsap.registerPlugin(ScrollTrigger);

window.Alpine = Alpine;
window.gsap = gsap;
window.ScrollTrigger = ScrollTrigger;

// Start Alpine
Alpine.start();

document.addEventListener('DOMContentLoaded', () => {
    const isTouchDevice = window.matchMedia('(pointer: coarse)').matches || 'ontouchstart' in window;
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    // 1. Top Scroll Progress Bar
    const progressBar = document.getElementById('scroll-progress');
    if (progressBar) {
        window.addEventListener('scroll', () => {
            const winScroll = document.documentElement.scrollTop || document.body.scrollTop;
            const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
            const scrolled = (winScroll / height) * 100;
            progressBar.style.width = scrolled + '%';
        }, { passive: true });
    }

    // 2. Desktop Mouse-Follow Glow in Hero
    const heroGlow = document.getElementById('hero-glow-follow');
    const heroSection = document.getElementById('hero-section');
    if (heroGlow && heroSection && !isTouchDevice && !prefersReducedMotion) {
        heroSection.addEventListener('mousemove', (e) => {
            const rect = heroSection.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            
            gsap.to(heroGlow, {
                x: x,
                y: y,
                duration: 0.8,
                ease: 'power2.out',
            });
        }, { passive: true });

        heroSection.addEventListener('mouseleave', () => {
            gsap.to(heroGlow, {
                opacity: 0,
                duration: 0.5,
            });
        });

        heroSection.addEventListener('mouseenter', () => {
            gsap.to(heroGlow, {
                opacity: 0.15,
                duration: 0.5,
            });
        });
    }

    // 3. Desktop Custom Cursor
    const cursorDot = document.getElementById('cursor-dot');
    const cursorRing = document.getElementById('cursor-ring');
    const cursorLabel = document.getElementById('cursor-label');

    if (cursorDot && cursorRing && !isTouchDevice && !prefersReducedMotion) {
        let mouseX = -100;
        let mouseY = -100;

        window.addEventListener('mousemove', (e) => {
            mouseX = e.clientX;
            mouseY = e.clientY;

            // Direct position for dot
            cursorDot.style.transform = `translate3d(${mouseX}px, ${mouseY}px, 0)`;

            // Smooth follow for ring
            gsap.to(cursorRing, {
                x: mouseX,
                y: mouseY,
                duration: 0.18,
                ease: 'power2.out',
            });
        }, { passive: true });

        // Hover states on interactive elements
        const bindCursorEvents = () => {
            document.querySelectorAll('a, button, [data-cursor]').forEach((el) => {
                el.addEventListener('mouseenter', () => {
                    const customType = el.getAttribute('data-cursor');
                    cursorRing.classList.add('cursor-active');

                    if (customType === 'view') {
                        cursorRing.classList.add('cursor-view');
                        if (cursorLabel) cursorLabel.textContent = 'VIEW →';
                    } else if (customType === 'explore') {
                        cursorRing.classList.add('cursor-explore');
                        if (cursorLabel) cursorLabel.textContent = 'EXPLORE';
                    } else {
                        cursorRing.classList.add('cursor-hover');
                        if (cursorLabel) cursorLabel.textContent = '';
                    }
                });

                el.addEventListener('mouseleave', () => {
                    cursorRing.classList.remove('cursor-active', 'cursor-view', 'cursor-explore', 'cursor-hover');
                    if (cursorLabel) cursorLabel.textContent = '';
                });
            });
        };

        bindCursorEvents();
        // Re-bind on dynamic Livewire updates
        document.addEventListener('livewire:navigated', bindCursorEvents);
        document.addEventListener('livewire:init', () => {
            if (window.Livewire) {
                window.Livewire.hook('commit', () => {
                    setTimeout(bindCursorEvents, 50);
                });
            }
        });
    }

    // 4. GSAP ScrollTrigger Reveals (Selective & Lightweight)
    if (!prefersReducedMotion) {
        const revealElements = document.querySelectorAll('.reveal-on-scroll');
        revealElements.forEach((el) => {
            gsap.fromTo(el, 
                { 
                    opacity: 0, 
                    y: 25 
                }, 
                {
                    opacity: 1, 
                    y: 0, 
                    duration: 0.7, 
                    ease: 'power3.out',
                    scrollTrigger: {
                        trigger: el,
                        start: 'top 88%',
                        toggleActions: 'play none none none',
                    }
                }
            );
        });
    }

    // 5. Global Command Palette Keyboard Shortcut (Ctrl+K or Cmd+K)
    window.addEventListener('keydown', (e) => {
        if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
            e.preventDefault();
            window.dispatchEvent(new CustomEvent('open-command-palette'));
        }
    });
});
