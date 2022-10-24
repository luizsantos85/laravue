import Vue from "vue";
import Vuex from 'vuex';

import Categories from './modules/categories/categories';
import Preloader from './modules/preloder/preloder';

Vue.use(Vuex);

const store = new Vuex.Store({
    modules: {
        categories: Categories,
        preloader: Preloader
    },
});

export default store;