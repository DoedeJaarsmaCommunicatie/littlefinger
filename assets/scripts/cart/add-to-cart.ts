import Axios from 'axios';

export class AddToCart {
    static action_query: string = '[data-action="add-to-cart"]';
    static product_query: string = '[data-product]';
    static quantity_query: string = '[name="quantity"]';

    products: Array<HTMLFormElement> = [];

    constructor() {
        this.init();
    }

    init() {
        this.scanProducts();
    }

    scanProducts(): AddToCart {
        let els = document.querySelectorAll(AddToCart.action_query);

        for (let i = 0; i < els.length; i++) {
            const element = els[i] as HTMLFormElement
            this.products.push(element);
            this.preventDef(element);
            this.addToCartEvent(element);
        }

        return this;
    }

    preventDef(el: HTMLFormElement): void {
        el.addEventListener('submit', (e) => e.preventDefault());
    }

    async addToCartEvent(el: HTMLFormElement) {
        el.addEventListener('submit', async (e) => {
            let data: FormData = new FormData();
            const product_id = this.getProductId(el);
            
            if (!product_id) {
                throw Error('Product ID not found');
            }

            data.set('product_id', product_id);
            data.set('quantity', this.getProductQuantity(el));

            const res = await Axios.post('?wc-ajax=add_to_cart', data);

            if (res.data.fragments) {
                this.injectMiniCart(res.data.fragments['div.widget_shopping_cart_content']);
            } 
        });
    }

    injectMiniCart(cart: string) {
        const el = document.querySelector('div.widget_shopping_cart_content')
        if (! el) {
            throw Error('Shopping cart does not exist');
        }

        el.outerHTML = cart;
        this.refreshCart();
    }

    refreshCart(): void {
        const cart = document.querySelector('div.widget_shopping_cart_content')!;
        cart.classList.add('active');

        cart.addEventListener('click', function (e) {
            //@ts-ignore
            if (e.target !== this) {
                return;
            }

            (<HTMLElement> e.target).classList.remove('active');
        });
    }

    getProductId(el: HTMLFormElement): string|undefined {
        return el.dataset['product'];
    }

    getProductQuantity(el: HTMLFormElement): string {
        let qty_el = el.querySelector(AddToCart.quantity_query) as HTMLInputElement;
        return qty_el.value || "1";
    }
}

export const addToCart = new AddToCart();