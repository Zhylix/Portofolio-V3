/**
 * Mobile Navigation Menu Alpine Component
 * Controls navbar backdrop, scroll state, drawer expansion, and accessibility.
 */
export function mobileMenu() {
    return {
        scrolled: false,
        mobileOpen: false,

        init() {
            this.updateScroll();
            window.addEventListener('scroll', () => {
                this.updateScroll();
            }, { passive: true });
        },

        updateScroll() {
            this.scrolled = (window.pageYOffset || document.documentElement.scrollTop) > 10;
        },

        toggle() {
            this.mobileOpen = !this.mobileOpen;
            if (this.mobileOpen) {
                document.body.style.overflow = 'hidden';
            } else {
                document.body.style.overflow = '';
            }
        },

        close() {
            this.mobileOpen = false;
            document.body.style.overflow = '';
        }
    };
}
