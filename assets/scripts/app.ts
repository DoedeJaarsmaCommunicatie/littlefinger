import { addToCart } from './cart/add-to-cart';
import { openFlyoutMenu } from "./shops/flyout-menu";

// @ts-ignore
window['cartAdder'] = addToCart;
// @ts-ignore
window['flyoutOpener'] = openFlyoutMenu;
