require('./bootstrap');
window.Vue = require('vue');

import VueRouter from 'vue-router';
Vue.use(VueRouter);

import App from './App.vue';

import Home from '../js/pages/Home';
import ContactList from '../js/pages/ContactList';
import AddContact from '../js/pages/AddContact';
import EditContact from '../js/pages/EditContact';

// import VueSweetalert2 from 'vue-sweetalert2';
// Window.Swal = require('sweetalert2');
// Vue.use(VueSweetalert2);

window.Swal = require('sweetalert2');

// import utils from '../js/helpers/utilities.js';
// Vue.prototype.$utils = utils;


import VueAxios from 'vue-axios';
import Vue from 'vue';

import axios from 'axios';

Vue.use(VueAxios, axios);


const routes = [
    {
        name:'/',
        path:'/',
        component: Home
    },{
        name:'contacts',
        path:'/contacts',
        component: ContactList
    },{
        name:'addContact',
        path:'/addContact',
        component: AddContact
    },{
        name:'get_contact',
        path:'/get_contact/edit/:id?',
        component: EditContact
    }
];

const router = new VueRouter({
    mode:'history',
    routes:routes
});

const app = new Vue(Vue.util.extend({ router }, App)).$mount('#app');
