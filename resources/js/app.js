require('./bootstrap');

window.Vue = require('vue');

//Import of manually created file for Vuetify setup
import Vuetify from "../plugins/vuetify";

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

const app = new Vue({
    vuetify: Vuetify,
    el: '#app'
});
