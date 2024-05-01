import '../css/app.css';
import './bootstrap';
import 'primeicons/primeicons.css';
import 'primevue/resources/primevue.min.css';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import PrimeVue from 'primevue/config';
import Toast from 'primevue/toast';
import ToastService from 'primevue/toastservice';
import Tooltip from 'primevue/tooltip';
import { createApp, DefineComponent, h } from 'vue';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import { Ziggy } from './ziggy';

const APP_NAME = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    progress: {
        color: '#4B5563',
        delay: 0,
        showSpinner: true,
    },
    resolve: (name) => {
        return resolvePageComponent(`./pages/${name}.vue`, import.meta.glob<DefineComponent>('./pages/**/*.vue'));
    },
    setup({ App, el, plugin, props }) {
        createApp({ render: () => h(App, props) })
            .component('Toast', Toast)
            .directive('tooltip', Tooltip)
            .use(plugin)
            .use(PrimeVue)
            .use(ToastService)
            .use(ZiggyVue, Ziggy)
            .mount(el);
    },
    title: (title) => {
        if (!title) return APP_NAME;
        return `${title} - ${APP_NAME}`;
    },
}).then(() => console.log('Application created successfully.'));
