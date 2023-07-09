import { createSSRApp, h, DefineComponent } from 'vue';
import { renderToString } from '@vue/server-renderer';
import { createInertiaApp } from '@inertiajs/vue3';
import createServer from '@inertiajs/vue3/server';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import { Ziggy } from './ziggy';
import PrimeVue from 'primevue/config';

const APP_NAME = import.meta.env.VITE_APP_NAME || 'Laravel';
const INERTIA_SSR_PORT = import.meta.env.VITE_INERTIA_SSR_PORT || 13714;

createServer((page) => {
    return createInertiaApp({
        page,
        render: renderToString,
        title: (title) => `${title} - ${APP_NAME}`,
        resolve: (name) =>
            resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob<DefineComponent>('./Pages/**/*.vue')),
        setup({ App, props, plugin }) {
            return createSSRApp({ render: () => h(App, props) })
                .use(plugin)
                .use(PrimeVue)
                .use(ZiggyVue, Ziggy);
        },
    });
}, INERTIA_SSR_PORT);
