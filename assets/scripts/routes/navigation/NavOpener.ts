import 'hammerjs';

export default class NavOpener {
    hammer: any;
    menu: HTMLElement;

    constructor() {
        delete Hammer.defaults.cssProps.userSelect;
        this.hammer = new Hammer(document.body);
        this.menu = document.querySelector<HTMLElement>('.navbar')!;
        this.boot();
    }

    boot(): void {
        this.hammer.on('panleft', (ev: any) => {
            if (!this.menu.classList.contains('active')) {
                this.menu.classList.add('active');
            }
        });

        this.hammer.on('panright', (ev: any) => {
            if (this.menu.classList.contains('active')) {
                this.menu.classList.remove('active')
            }
        });

        document.body.addEventListener('click', (ev: any) => {
            if (ev.target == this.menu || this.menu.contains(ev.target)) {
                return;
            }

            if (this.menu.classList.contains('active')) {
                this.menu.classList.remove('active')
            }
        });
    }
}
