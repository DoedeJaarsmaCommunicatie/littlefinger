import { AddToCart } from "./cart/add-to-cart";
import { OpenFlyoutMenu } from "./shops/flyout-menu";
import NavOpener from "./navigation/NavOpener";

export default {
    init() {
        // Fires on all pages.
        new AddToCart();
        new OpenFlyoutMenu();
        new NavOpener();
    },
    finalize() {
        // Fires on all pages after page specific JS is loaded.
    }
}
