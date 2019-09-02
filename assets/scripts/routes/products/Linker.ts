import Axios from "axios";

export default class Linker {
    // @ts-ignore
    els: NodeListOf<HTMLElement>|any[]|null;

    constructor (
        readonly selector: string,
        readonly slug: string
    ) {
        this.init();
    }

    init() {
        this.setElements();

        if (!this.elementsExist()) {
            throw new Error(`${this.slug.toUpperCase()} niet gevonden.`)
        }

        this.loop();
    }

    setElements(): void {
        this.els = document.querySelectorAll(`[data-attribute=${this.selector}]`);
    }

    elementsExist(): boolean {
        return this.els!.length >= 1;
    }

    loop(): void {
        for (let elem in this.els) {
            if (this.els.hasOwnProperty(elem)) {
                // @ts-ignore
                const el = this.els[elem] as HTMLElement;

                Axios.get(`/wp-json/wp/v2/${this.slug}?slug=${el.dataset.value}`)
                    .then(res => {
                        el.innerHTML = `<a href="${res.data[0].link}">${res.data[0].title.rendered}</a>`
                    })
                    .catch(e => {
                        // Do nothing. No link found for this 'domein'
                    })
            }
        }
    }
}

export const domeinLinker = () => new Linker('domein', 'producent');
export const streekLinker = () => new Linker('streek', 'streek');
export const druifLinker = () => new Linker('druif', 'druif');
