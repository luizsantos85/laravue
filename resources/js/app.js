/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

import router from './routes/routers'
import store from './vuex/store'

// Vue.component('test', require('./components/TestComponent').default)
Vue.component('admin-component', require('./components/admin/AdminComponent').default);

const app = new Vue({
    router,
    store,
    el: '#app',
});
