require('./bootstrap');

window.Vue = require('vue');

import Vuetify from "../plugins/vuetify";
import store from "./store";
import router from './router'

Vue.component('bar-component', require('./components/BarComponent.vue').default);
Vue.component('product-cu-component', require('./components/ProductCUComponent.vue').default);
Vue.component('products-list-component', require('./components/ProductsListComponent.vue').default);
Vue.component('users-list-component', require('./components/UsersListComponent.vue').default);
Vue.component('user-cu-component', require('./components/UserCUComponent.vue').default);

const app = new Vue({
    vuetify: Vuetify,
    store,
    router,
    el: '#app'
});
