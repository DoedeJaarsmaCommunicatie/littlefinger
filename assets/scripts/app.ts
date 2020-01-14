import Router from './tools/Router';
import './bootstrap';
import ready from './tools/Ready';

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

ready(router.loadEvents());
