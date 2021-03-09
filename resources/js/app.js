/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import Router from 'vue-router';
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'

window.Vue = require('vue').default;
window.Vue.use(Router);

// Make BootstrapVue available throughout your project
Vue.use(BootstrapVue);
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin);



const router = new Router({
    mode: "history",
    routes: [
        {
            path: '/',
            name: 'HomePage',
            component: () => import("./pages/home/Index")
        },
        {
            path: '/post',
            name: 'SinglePostWrapper',
            component:() => import("./pages/post/Index"),
            children: [
                {
                    path: ':slug',
                    name: 'SinglePost',
                    component: () => import("./pages/post/Single"),
                }
            ]
        }
    ]
});
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

Vue.component("header-menu", require("./components/Header").default);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router
});
