/**
 * Command Palette Alpine Component
 * Handles Ctrl+K palette search, keyboard navigation, and developer terminal easter egg.
 */
export function commandPalette(config = {}) {
    return {
        isOpen: false,
        search: '',
        easterEgg: false,
        activeIndex: -1,
        terminalInput: '',
        terminalOutput: [
            'Zephyr System OS v4.2.0 [System Kernel: Laravel 13 on PHP 8.4]',
            'Architecture: High-Performance Web Applications & Enterprise Systems',
            'Type: help, neofetch, skills, projects, clear, or exit to interact.'
        ],
        navItems: config.navItems || [
            { title: 'Home', subtitle: 'Overview & system landing', url: '/', badge: 'Nav' },
            { title: 'About', subtitle: 'Developer identity & background', url: '/about', badge: 'Bio' },
            { title: 'Projects', subtitle: 'Case studies & production systems', url: '/projects', badge: 'Work' },
            { title: 'Skills', subtitle: 'Capabilities & technical competencies', url: '/skills', badge: 'Stack' },
            { title: 'Achievements', subtitle: 'Distinctions, awards & honors', url: '/achievements', badge: 'Honors' },
            { title: 'Certificates', subtitle: 'Verified licenses & certifications', url: '/certificates', badge: 'Certs' },
            { title: 'Contact', subtitle: 'Start an inquiry or technical collaboration', url: '/contact', badge: 'Contact' },
        ],

        init() {
            // Listen to window open event
            window.addEventListener('open-command-palette', () => {
                this.open();
            });
        },

        open() {
            this.isOpen = true;
            this.activeIndex = -1;
            this.$nextTick(() => {
                if (this.$refs.searchInput) {
                    this.$refs.searchInput.focus();
                }
            });
        },

        close() {
            this.isOpen = false;
            this.easterEgg = false;
            this.activeIndex = -1;
        },

        navigateDown() {
            const items = this.$el.querySelectorAll('.palette-item');
            if (items.length) {
                this.activeIndex = (this.activeIndex + 1) % items.length;
                items[this.activeIndex]?.focus();
            }
        },

        navigateUp() {
            const items = this.$el.querySelectorAll('.palette-item');
            if (items.length) {
                this.activeIndex = (this.activeIndex - 1 + items.length) % items.length;
                if (this.activeIndex < 0) {
                    this.$refs.searchInput?.focus();
                } else {
                    items[this.activeIndex]?.focus();
                }
            }
        },

        handleEnter() {
            const items = this.$el.querySelectorAll('.palette-item');
            if (items.length && this.activeIndex >= 0) {
                items[this.activeIndex]?.click();
            } else if (items.length) {
                items[0]?.click();
            }
        },

        handleSearchInput() {
            const query = this.search.trim().toLowerCase();
            if (['terminal', 'neofetch', 'matrix', 'sudo'].includes(query)) {
                this.easterEgg = true;
                this.search = '';
            }
        },

        handleTerminalCommand() {
            const raw = this.terminalInput.trim();
            const cmd = raw.toLowerCase();
            this.terminalOutput.push('$ ' + raw);

            if (cmd === 'help') {
                this.terminalOutput.push('Available commands: neofetch, skills, projects, clear, exit');
            } else if (cmd === 'neofetch') {
                this.terminalOutput.push('  ██████╗  Host: Zephyr / Helmy Yunan Nasution');
                this.terminalOutput.push('  ██╔══██╗ OS: Arch / Ubuntu / Laravel 13');
                this.terminalOutput.push('  ██████╔╝ Stack: PHP 8.4 + MySQL + Livewire 4 + Tailwind CSS 4');
                this.terminalOutput.push('  ██╔══██╗ Uptime: 99.99% Reliability');
                this.terminalOutput.push('  ██████╔╝ Status: AVAILABLE FOR COLLABORATION');
            } else if (cmd === 'skills') {
                this.terminalOutput.push('Core Stack: Laravel 13, PHP 8.4, MySQL, Livewire 4, Tailwind CSS 4, Alpine.js, Spatie MediaLibrary, Filament 5');
            } else if (cmd === 'projects') {
                this.terminalOutput.push('Featured Systems: Zephyr Portfolio, Enterprise Admin CMS, High-Performance Web Applications');
            } else if (cmd === 'clear') {
                this.terminalOutput = [];
            } else if (cmd === 'exit' || cmd === 'quit') {
                this.easterEgg = false;
            } else {
                this.terminalOutput.push('command not found: ' + raw + '. Type "help" for manual.');
            }
            this.terminalInput = '';
        }
    };
}
