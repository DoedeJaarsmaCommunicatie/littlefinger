import CamelCase from "./CamelCase";

class Router {
    routes: any[];

    constructor(routes: any) {
        this.routes = routes;
    }

    fire(route: any, event = 'init', arg = null) {
        document.dispatchEvent(new CustomEvent('routed', {
            bubbles: true,
            detail: {
                route,
                fn: event,
            }
        }));

        const fire = route !== ''
            && this.routes[route]
            && typeof this.routes[route][event] === 'function';

        if (fire) {
            this.routes[route][event](arg);
        }
    }

    loadEvents() {
        this.fire('common');

        document.body.className
            .toLowerCase()
            .replace(/-/g, '_')
            .split(/\s+/)
            .map(CamelCase)
            .forEach(className => {
                this.fire(className);
                this.fire(className, 'finalize');
            });

        this.fire('common', 'finalize');
    }
}

export default Router;
