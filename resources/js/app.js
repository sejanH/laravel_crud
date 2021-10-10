/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import Router from 'vue-router';
import titleMixin from './titleMixin';
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue';
import VueCarousel from 'vue-carousel';
// Import component
import Loading from 'vue-loading-overlay';
// Import stylesheet
import 'vue-loading-overlay/dist/vue-loading.css';
import "../../public/css/app.css";
import Vue from 'vue';
window.Vue = require('vue').default;
window.Vue.use(Router);

// Make BootstrapVue available throughout your project
Vue.use(BootstrapVue);
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin);
// vue carousel by ssense
Vue.use(VueCarousel);
//loader
Vue.component("Loading",Loading);
// mixin to update title accordingly
Vue.mixin(titleMixin)



const router = new Router({
    mode: "history",
    routes: [
        {
            path: '/',
            name: 'HomePage',
            component: () => import("./pages/home/Index")
        },
        {
            path:'/new',
            name:'CreatePost',
            component: () => import("./pages/post/Create")
        },
        {
            path: '/post/:slug',
            name: 'SinglePostWrapper',
            component: () => import("./pages/post/Index"),
            meta: {
                title: "Post"
            },
            // children: [
            //     {
            //         path: ':slug',
            //         name: 'SinglePost',
            //         component: () => import("./pages/post/Single"),
            //     }
            // ]
        },
        {
            path: '/category/:slug',
            name: 'CategoryPage',
            component: () => import("./pages/category/Index"),
            meta: {
                title: "Category"
            }
        },
        {
            path: "*" || "/404",
            name: 'NotFound',
            component: () => import("./pages/404")

        },
        {
            path: '/login',
            name: 'Login',
            // component: () => import("./pages/auth/Login")
        },
        {
            path: '/register',
            name: 'Regsiter',
            // component: () => import("./pages/auth/Login")
        }
    ]
});

Vue.component("header-menu", require("./components/Header").default);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router,
    data() {
        return {
            state: __STATE
        }
    }
});
