import Vue from 'vue'
import VueRouter from 'vue-router'
Vue.use(VueRouter);

import App from './App.vue'
import route from './routes'

const router = new VueRouter({
    mode : 'history',
    routes : route,
    linkActiveClass : 'active'
});

const vue = new Vue({
    el : '#app',
    components : {App},
    router
});
