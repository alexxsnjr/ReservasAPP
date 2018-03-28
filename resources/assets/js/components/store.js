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
            router.replace('/dashboard')

        })
        .catch(error => console.log(error))
    },
      logout ({commit}) {
          commit('clearAuthData')

          localStorage.removeItem('token')

          router.replace('/signin')
      },
    fetchUser ({commit, state}) {
      if (!state.idToken) {
        return
      }
      globalAxios.get('/users.json' + '?auth=' + state.idToken)
        .then(res => {
          console.log(res)
          const data = res.data
          const users = []
          for (let key in data) {
            const user = data[key]
            user.id = key
            users.push(user)
          }
          console.log(users)
          commit('storeUser', users[0])
        })
        .catch(error => console.log(error))
    }
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