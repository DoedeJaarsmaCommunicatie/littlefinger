import { AddToCart } from "./cart/add-to-cart";
import NavOpener from "./navigation/NavOpener";
import Mailchimp from './MC/Mailchimp';
import { FilterOpener } from "./shops/FilterOpener";
import './products/LazyLoader';

export default {
    init() {
        // Fires on all pages.
        new AddToCart();
        new NavOpener();
        new Mailchimp();
        FilterOpener();
        openShortList();
    },
    finalize() {
        // Fires on all pages after page specific JS is loaded.
    }
}

const openShortList = () => {
    const lists = document.querySelectorAll('.shortened-list');
    if (!lists || lists.length === 0) {
        return;
    }

    for ( let i = 0; i < lists.length; i++ ) {
        lists[i].addEventListener('click', () => lists[i].classList.add('active'));
    }
};
