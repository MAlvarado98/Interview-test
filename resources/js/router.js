import Vue from 'vue';
import Router from 'vue-router';

Vue.use(Router);

import home from './components/HomeComponent';
import articles from './components/ArticlesComponent';
import cart from './components/CartComponent';
import login from './components/LoginComponent';
import register from './components/RegisterComponent';
import hooks from './components/basic/hooks.vue';

const routes = [
    {
        path: '/',
        component: home
    },
    {
        path: '/articles',
        component: articles
    },
    {
        path: '/cart',
        component: cart
    },
    {
        path: '/login',
        component: login
    },
    {
        path: '/register',
        component: register
    },

    //vue hooks
    {
        path: '/hooks',
        component: hooks
    }
]

export default new Router({
    mode: 'history',
    routes
})