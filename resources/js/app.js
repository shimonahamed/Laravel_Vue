import Vue from 'vue'
import VueRouter from 'vue-router'
Vue.use(VueRouter);

import App from './App.vue'
import route from './routes'

import axios from "axios"
import VueAxios from "vue-axios"

Vue.use(VueAxios, axios)

import httpMixin from "./Mixins/Httpmix"
import commonMixin from "./Mixins/CommonMixins"
Vue.mixin(httpMixin)
Vue.mixin(commonMixin)

import Toast from 'vue-toastification';
import 'vue-toastification/dist/index.css';

Vue.use(Toast);

const router = new VueRouter({
    mode : 'history',
    routes : route,
    linkActiveClass : 'active'
});

const vue = new Vue({
    el : '#app',
    components : {App},
    router,axios
});
