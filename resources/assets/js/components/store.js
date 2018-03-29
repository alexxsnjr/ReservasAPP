import Vue from 'vue'
import Vuex from 'vuex'
import axios from './axios-auth'
import globalAxios from 'axios'

import router from './router'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    idToken: null,

  },
  mutations: {
    authUser (state, userData) {
      state.idToken = userData.token

    },

  },
  actions: {
    login ({commit, dispatch}, authData) {
      axios.post('/login', {
        email: authData.email,
        password: authData.password,

      })
        .then(res => {
          console.log(res)
            commit('authUser', {
                token: res.data.idToken,

            });
            localStorage.setItem('token', res.data.idToken)

            router.replace('/dashboard')

        })

    },
      logout ({commit}) {

          localStorage.removeItem('token')
          router.replace('/signin')
      },

  },
  getters: {
   isAuthenticated (state) {
      if (state.idToken !== null){
        return true;
      }else {
        return false;
      }
   }
  }
})