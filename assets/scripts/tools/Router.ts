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

        Promise.resolve(this.routes[route])
            .then(res => {
                const fire = route !== ''
                    && res
                    && typeof res[event] === 'function';

                if (fire) {
                    this.routes[route][event](arg);
                }
            });
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
