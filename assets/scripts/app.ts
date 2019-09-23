import Router from './tools/Router';

// Import routes
import common from './routes/common';
import home from './routes/home';
import singleProduct from "./routes/singleProduct";
import postTypeArchiveProduct from "./routes/postTypeArchiveProduct";

const routes = {
    common,
    home,
    singleProduct,
    postTypeArchiveProduct
};

const router = new Router(routes);

// @ts-ignore
window['routes'] = router;

document.addEventListener('DOMContentLoaded', () => router.loadEvents());
