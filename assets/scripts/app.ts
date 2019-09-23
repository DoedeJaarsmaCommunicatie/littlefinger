import Router from './tools/Router';

// Import routes
import common from './routes/common';
import home from './routes/home';
import singleProduct from "./routes/singleProduct";

const routes = {
    common,
    home,
    singleProduct,
};

const router = new Router(routes);

// @ts-ignore
window['routes'] = router;

document.addEventListener('DOMContentLoaded', () => router.loadEvents());
