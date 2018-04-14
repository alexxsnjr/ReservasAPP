import Vue from 'vue'
import VueRouter from 'vue-router'

import store from './store'


import DashboardPage from './components/dashboard/dashboard.vue'
import SigninPage from './components/auth/signin.vue'
import AulasDisponibles from './components/dashboard/formulario/Answer.vue'
Vue.use(VueRouter)

const routes = [
  { path: '/', component: SigninPage },
  { path: '/signin', component: SigninPage },
  { path: '/dashboard', component: DashboardPage},
  { path: '/aulas-disponibles', component: AulasDisponibles},
]

export default new VueRouter({mode: 'history', routes})