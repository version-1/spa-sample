import Vue from 'vue';
import VueRouter from 'vue-router';
require('./bootstrap');

Vue.use(VueRouter);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
 const router = new VueRouter({
    mode: 'history',
    routes: [
        { path: '/', component: require('./components/Example.vue') },
        { path: '/example', component: require('./components/Example.vue') },
        { path: '/example/1', component: require('./components/Example1.vue') },
        { path: '/example/2', component: require('./components/Example2.vue') },
    ]
});

const app = new Vue({
    router,
    el: '#app'
});
