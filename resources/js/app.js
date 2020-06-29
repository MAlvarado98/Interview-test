require('./bootstrap');

window.Vue = require('vue');

import Vuetify from "../plugins/vuetify";
import store from "./store";
import router from './router'

Vue.component('bar-component', require('./components/BarComponent.vue').default);

const app = new Vue({
    vuetify: Vuetify,
    store,
    router,
    el: '#app'
});
