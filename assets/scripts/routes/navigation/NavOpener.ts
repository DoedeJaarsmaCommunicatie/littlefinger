
export default class NavOpener {
    menu: HTMLElement;

    constructor() {
        this.menu = document.querySelector<HTMLElement>('.navbar')!;
        this.boot();
    }

    boot(): void {
        const button = document.querySelector('.menu-button');

        if (!button) {
            return;
        }

        button.addEventListener('click',  () => {
            if (!this.menu.classList.contains('active')) {
                this.menu.classList.add('active');
            }
        });

        document.body.addEventListener('click', (ev: any) => {
            if (ev.target == this.menu || this.menu.contains(ev.target) ||
                ev.target == button || button.contains(ev.target)) {
                return;
            }

            if (this.menu.classList.contains('active')) {
                this.menu.classList.remove('active')
            }
        });
    }
}
