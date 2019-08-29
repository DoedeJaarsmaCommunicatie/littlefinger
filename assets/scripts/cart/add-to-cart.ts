import Axios from 'axios';

export class AddToCart {
    static action_query: string = '[data-action="add-to-cart"]';
    static product_query: string = '[data-product]';
    static quantity_query: string = '[name="quantity"]';

    products: HTMLFormElement[] = [];

    constructor() {
        this.init();
    }

    init(): void {
        this.scanProducts();
    }

    scanProducts(): AddToCart {
        let els = document.querySelectorAll(AddToCart.action_query);

        for (let i = 0; i < els.length; i++) {
            const element = els[i] as HTMLFormElement;
            this.products.push(element);
            this.preventDef(element);
            this.addToCartEvent(element);
        }

        return this;
    }

    // noinspection JSMethodCanBeStatic
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
                this.refreshCartAmount(res.data.fragments['cart_contents_count']);
            }
        });
    }

    injectMiniCart(cart: string): void {
        const el = document.querySelector('div.widget_shopping_cart_content');
        if (! el) {
            throw Error('Shopping cart does not exist');
        }

        el.outerHTML = cart;
        this.refreshCart();
    }

    refreshCart(): void {
        const cart = document.querySelector('div.widget_shopping_cart_content')!;
        const close_btn = document.querySelector<HTMLButtonElement>('.js-close-cart')!;
        cart.classList.add('active');

        cart.addEventListener('click', function (e) {
            // @ts-ignore
            if (e.target !== this) {
                return;
            }

            (<HTMLElement> e.target).classList.remove('active');
        });

        close_btn.addEventListener('click', () => {
            cart.classList.remove('active');
        })
    }

    // noinspection JSMethodCanBeStatic
    refreshCartAmount(count: number|string): void {
        const badge = document.querySelector<HTMLSpanElement>('.js-cart-amount')!;

        badge.dataset['amount'] = count.toString() as string;
        badge.innerText = count.toString() as string;
    }

    // noinspection JSMethodCanBeStatic
    getProductId(el: HTMLFormElement): string|undefined {
        return el.dataset['product'];
    }

    // noinspection JSMethodCanBeStatic
    getProductQuantity(el: HTMLFormElement): string {
        let qty_el = el.querySelector<HTMLInputElement>(AddToCart.quantity_query);
        if (qty_el) {
            return qty_el.value;
        }

        return "1";
    }
}

export const addToCart = new AddToCart();
