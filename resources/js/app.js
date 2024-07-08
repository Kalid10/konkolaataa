import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import GuestLayout from "@/Layouts/GuestLayout.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {createPinia} from "pinia";

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

function getLayout(name) {
    switch (true) {
        case name.startsWith("Auth/") || name === "Welcome":
            return GuestLayout;
        case name.startsWith("Pricing"):
            return AuthenticatedLayout;
        default:
            return AuthenticatedLayout;
    }
}
createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => {
        const pages = import.meta.glob("./Pages/**/*.vue", { eager: true });
        let page = pages[`./Pages/${name}.vue`];
        page.default.layout = getLayout(name, page);
        return page;
    }, setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(createPinia())
            .use(ZiggyVue)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
