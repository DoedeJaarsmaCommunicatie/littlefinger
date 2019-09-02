import { AddToCart } from "./cart/add-to-cart";
import { OpenFlyoutMenu } from "./shops/flyout-menu";

export default {
    init() {
        // Fires on all pages.
        new AddToCart();
        new OpenFlyoutMenu();
    },
    finalize() {
        // Fires on all pages after page specific JS is loaded.
    }
}
