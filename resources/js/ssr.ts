import { createInertiaApp } from '@inertiajs/vue3';
import createServer from '@inertiajs/vue3/server';
import { renderToString } from '@vue/server-renderer';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import PrimeVue from 'primevue/config';
import Toast from 'primevue/toast';
import ToastService from 'primevue/toastservice';
import { createSSRApp, DefineComponent, h } from 'vue';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import { Ziggy } from './ziggy';

const APP_NAME = import.meta.env.VITE_APP_NAME || 'Laravel';
const INERTIA_SSR_PORT = import.meta.env.VITE_INERTIA_SSR_PORT || 13714;

createServer((page) => {
    return createInertiaApp({
        page,
        render: renderToString,
        resolve: (name) =>
            resolvePageComponent(`./pages/${name}.vue`, import.meta.glob<DefineComponent>('./pages/**/*.vue')),
        setup({ App, plugin, props }) {
            return createSSRApp({ render: () => h(App, props) })
                .component('Toast', Toast)
                .use(plugin)
                .use(PrimeVue)
                .use(ToastService)
                .use(ZiggyVue, Ziggy);
        },
        title: (title) => `${title} - ${APP_NAME}`,
    });
}, INERTIA_SSR_PORT);
