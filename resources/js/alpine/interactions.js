/**
 * General UI Interactions & Contact Form Alpine Component
 */
export function contactForm(initial = {}) {
    return {
        step: initial.step || 1,
        selectedType: initial.type || 'project',
        subject: initial.subject || '',
        name: initial.name || '',
        email: initial.email || '',
        message: initial.message || '',
        typeLabels: {
            website: 'Website',
            collaboration: 'Collaboration',
            freelance: 'Freelance Contract',
            project: 'System Architecture Project',
            just_say_hi: 'Just Say Hi'
        },

        nextStep() {
            if (this.step === 1 && !this.selectedType) return;
            if (this.step < 3) this.step++;
        },

        prevStep() {
            if (this.step > 1) this.step--;
        }
    };
}

export function tabSwitcher(initialTab = 'code') {
    return {
        activeTab: initialTab,
        setTab(tab) {
            this.activeTab = tab;
        }
    };
}

export function interactions() {
    return {
        copyToClipboard(text, successCallback) {
            if (navigator.clipboard) {
                navigator.clipboard.writeText(text).then(() => {
                    if (typeof successCallback === 'function') successCallback();
                });
            }
        }
    };
}
