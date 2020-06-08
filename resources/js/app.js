require('./bootstrap');

import Vue from 'vue';
import VueRouter from 'vue-router';
import { routes } from './routes';

Vue.use(VueRouter);

const router = new VueRouter({
    routes,
    mode: "history"
});

/**
 * Automatically register the Vue components.
 * Eg. ./ExampleComponent.vue -> <example-component></example-component>
 */

const files = require.context('./components', true, /\.vue$/i);
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

const app = new Vue({
    router
}).$mount('#app');
