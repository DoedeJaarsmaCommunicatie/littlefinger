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
            const { x } = this.getStartDirection(ev);

            let maxWindow = window.innerWidth;
            let offsetWindow = maxWindow - (.2 * maxWindow);

            if (x <= offsetWindow) {
                return;
            }

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

    getStartDirection(e: any) {
        const deltaX = e.deltaX;
        const deltaY = e.deltaY;
        const finalX = e.srcEvent.pageX || e.srcEvent.screenX || 0;
        const finalY = e.srcEvent.pageY || e.srcEvent.screenY || 0;

        return {
            x: finalX - deltaX,
            y: finalY - deltaY
        };
    }
}
