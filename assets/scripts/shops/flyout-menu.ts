export class OpenFlyoutMenu {
    static open_query: string = '.js-menu-open';
    static flyout_query: string = '.shop-container-slider';

    static active_class: string = 'active';

    constructor() {
        this.init();
    }

    init(): void {
        this.openFlyOut();
        this.closeFlyOut();
    }

    openFlyOut(): void {
        // @ts-ignore
        for (let el of OpenFlyoutMenu.getElements(OpenFlyoutMenu.open_query)) {
            el
                .addEventListener('click', () => {
                    OpenFlyoutMenu.getElement(OpenFlyoutMenu.flyout_query)
                        .classList
                        .add(OpenFlyoutMenu.active_class);
                });
        }
    }

    closeFlyOut(): void {
        OpenFlyoutMenu
            .getElement(OpenFlyoutMenu.flyout_query)
            .addEventListener('click', function (ev) {

                if (ev.target !== this) {
                    return;
                }

                OpenFlyoutMenu
                    .getElement(OpenFlyoutMenu.flyout_query)
                    .classList
                    .remove(OpenFlyoutMenu.active_class);
        });
    }

    static getElement(name: string): HTMLElement {
        const el = document.querySelector<HTMLElement>(name);
        if (!el) {
            throw new Error('Element not found.');
        }
        return el;
    }

    static getElements(name: string): NodeListOf<Element> {
        const els = document.querySelectorAll(name);
        if (els.length === 0) {
            throw new Error('No elements found.');
        }
        return els;
    }
}

export const openFlyoutMenu = new OpenFlyoutMenu();
