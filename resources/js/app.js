import '../css/app.css';

import 'bootstrap';
import 'bootstrap-icons/font/bootstrap-icons.css';

import 'admin-lte';
import '@fortawesome/fontawesome-free/css/all.min.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';

import MainLayout from './Layouts/MainLayout.vue';

createInertiaApp({
    resolve: (name) => {
        const pages = import.meta.glob('./Pages/**/*.vue', {
            eager: true,
        });

        const page = pages[`./Pages/${name}.vue`];

        if (!page) {
            throw new Error(`Page Inertia introuvable : ${name}`);
        }

        page.default.layout ??= MainLayout;

        return page;
    },

    setup({ el, App, props, plugin }) {
        createApp({
            render: () => h(App, props),
        })
            .use(plugin)
            .mount(el);
    },
});