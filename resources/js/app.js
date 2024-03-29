require('./bootstrap');

window.Vue = require('vue');

import Vuetify from "../plugins/vuetify";
import store from "./store/index";
import router from './router';
import common from './common';
import vueCountryRegionSelect from 'vue-country-region-select';
import { BootstrapVue } from 'bootstrap-vue';
import Toasted from 'vue-toasted';
 
Vue.use(Toasted,{
    iconPack : 'material'
});
Vue.use(vueCountryRegionSelect);
Vue.use(BootstrapVue);

Vue.component('home-component', require('./components/HomeComponent.vue').default);
Vue.component('bar-component', require('./components/BarComponent.vue').default);
Vue.component('product-cu-component', require('./components/productComponents/ProductCUComponent.vue').default);
Vue.component('products-list-component', require('./components/productComponents/ProductsListComponent.vue').default);
Vue.component('users-list-component', require('./components/userComponents/UsersListComponent.vue').default);
Vue.component('user-cu-component', require('./components/userComponents/UserCUComponent.vue').default);

Vue.mixin(common);

const app = new Vue({
    vuetify: Vuetify,
    store,
    router,
    el: '#app'
});
