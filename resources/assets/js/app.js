
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import Vue from 'vue'

import axios from 'axios'

import router from './components/router'
import store from './components/store'

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('app', require('./components/App.vue'));

const app = new Vue({
    el: '#app',
    router,
    store,
});



axios.defaults.baseURL = 'http://aulas.app'
axios.defaults.headers.get['Accepts'] = 'application/json'



