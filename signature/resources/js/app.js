/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Vue from 'vue';
window.Vue = require('vue');
import Vuetify from 'vuetify';
import '@mdi/font/css/materialdesignicons.css'
import VueRouter from 'vue-router';

import inicio from './components/InicioComponent';
import inmuebles from './components/InmuebleComponent';
import usuarios from './components/UsuariosComponent';
import singin from './components/SinginComponent';
import login from './components/LoginComponent';

Vue.use(VueRouter);
Vue.use(Vuetify);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

Vue.component('inmuebles', require('./components/InmuebleComponent.vue').default);
Vue.component('inicio', require('./components/InicioComponent.vue').default);
Vue.component('usuarios', require('./components/UsuariosComponent.vue').default);
Vue.component('singin', require('./components/SinginComponent.vue').default);
Vue.component('login', require('./components/LoginComponent.vue').default);


Vue.component("inicio", inicio);
Vue.component("inmuebles", inmuebles);
Vue.component("usuarios", usuarios);
Vue.component("singin", singin);
Vue.component("login", login);

const routes = [
    { path: "/", component: inmuebles },
    { path: "/inicio", component: inmuebles },
    { path: "/inmuebles", component: inmuebles },
    { path: "/usuarios", component: usuarios },
    { path: "/singin", component: singin },
    { path: "/login", component: login },
];

const router = new VueRouter({
    routes,
    mode: "history",

});

Vue.config.productionTip = false;

new Vue({
    el: '#app',
    vuetify: new Vuetify(),
    router,
});
