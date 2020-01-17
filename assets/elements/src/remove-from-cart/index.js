import { define } from 'hybrids';

export default async () => {
    if (document.querySelectorAll('remove-from-cart').length > 0) {
        const render = async () => (await import(/* webpackChunkName: "dist/elements/remove-from-cart" */ './element')).default

        define('remove-from-cart', await render());
    }
};
