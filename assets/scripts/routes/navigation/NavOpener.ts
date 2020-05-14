
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
            this.setMobileMenuTop(this.menu);
            if (this.menu.classList.contains('active')) {
                this.menu.classList.remove('active');
                document.body.style.overflow = '';
            } else {
                this.menu.classList.add('active');
                document.body.style.overflow = 'hidden';
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

    setMobileMenuTop(menu: any): void {
        const header = document.querySelector('.logo-header'),
            topper = document.querySelector('header.header')!,
            offset = header!.getBoundingClientRect().bottom - document.body.getBoundingClientRect().top;

        if (!this.isOutOfViewport(header).any) {
            menu.style.top = (offset - 2) + 'px';
        } else {
            menu.style.top = (topper.clientHeight) + 'px';
        }
    }

    isOutOfViewport(elem: any) {
        const bounding = elem.getBoundingClientRect(),
            out = { top: false, left: false, bottom: false, right: false, any: false, all: false }

        out.top = bounding.top < 0;
        out.left = bounding.left < 0;
        out.bottom = bounding.bottom > (window.innerHeight || document.documentElement.clientHeight);
        out.right = bounding.right > (window.innerWidth || document.documentElement.clientWidth);
        out.any = out.top || out.left || out.bottom || out.right;
        out.all = out.top && out.left && out.bottom && out.right;

        return out;

    };
}
