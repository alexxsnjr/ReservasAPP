import Vue from 'vue'
import VueRouter from 'vue-router'

import store from './store'


import DashboardPage from './components/dashboard/dashboard.vue'
import SigninPage from './components/auth/signin.vue'

Vue.use(VueRouter)

const routes = [
    {path: '/', component: SigninPage},
    {path: '/signin', component: SigninPage},
    {path: '/dashboard', component: DashboardPage},

]

export default new VueRouter({mode: 'history', routes})