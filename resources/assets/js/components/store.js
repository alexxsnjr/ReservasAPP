import Vue from 'vue'
import Vuex from 'vuex'
import axios from './axios-auth'


import router from './router'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    idToken: null,
    userId: null,
    userName: null,
    tipos: [],
    requerimientos: null,
  },
  mutations: {
    tokenUser (state, userData) {
      state.idToken = userData.token

    },
    authUser (state, userData){
        state.userId = userData.userID,
        state.userName = userData.userName

    },
    tipos (state, tipos){
        state.tipos = tipos;

    },
    clearAuthData (state) {
      state.idToken = null
    }

  },
  actions: {
    login ({commit, dispatch}, authData) {
      axios.post('/login', {
        email: authData.email,
        password: authData.password,

      })
        .then(res => {

            commit('tokenUser', {
                token: res.data.token,

            });

            dispatch('fetchUser')
            dispatch('fetchInfo')


        })
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
          axios.post('/user', {
              token:state.idToken
          })
              .then(res => {

                commit('authUser',{
                    userID: res.data.user.id,
                    userName: res.data.user.name,

                })
                  router.replace('/dashboard')
              })
              .catch(error => console.log(error))
      },
      fetchInfo({commit , state}){

        axios.get('/tipos', { headers: { Authorization: `Bearer ${state.idToken}` } })
        .then(res=>{

            const data = [];

            for (var i = 0 ; i < res.data.tipos.length ; i++){
                data.push( res.data.tipos[i].tipo);
            }

            commit('tipos', data);

        })
      }

  },
  getters: {
       isAuthenticated (state) {
          if (state.idToken !== null){
            return true;
          }else {
            return false;
          }
       },
      getUserName(state) {
           return state.userName;
      },
      getTiposAula(state) {

           return state.tipos;
      }

  }
})