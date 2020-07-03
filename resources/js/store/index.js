import Vue from 'vue';
import Vuex from 'vuex';

import currentUser from './modules/currentUser';
import product from './modules/product';
import cart from './modules/cart';

Vue.use(Vuex);

export default new Vuex.Store({
    modules:{
        currentUser,
        product,
        cart
    }
})