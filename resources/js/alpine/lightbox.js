/**
 * Lightbox & Image Preview Alpine Component
 * Controls modal image display, zooming, and keyboard dismissal.
 */
export function lightbox() {
    return {
        isOpen: false,
        activeImage: '',
        activeTitle: '',

        open(url, title = '') {
            this.activeImage = url;
            this.activeTitle = title;
            this.isOpen = true;
            document.body.style.overflow = 'hidden';
        },

        close() {
            this.isOpen = false;
            this.activeImage = '';
            this.activeTitle = '';
            document.body.style.overflow = '';
        }
    };
}
