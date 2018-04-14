import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'


import router from './router'

Vue.use(Vuex)


 const state= {
    idToken: null,
    userId: null,
    userName: null,
    aulas: [],
    tipos: [],
    equipamientos: [],
  };
 const mutations ={
    tokenUser (state, userData) {
      state.idToken = userData.token

    },
    authUser (state, userData){
        state.userId = userData.userID,
        state.userName = userData.userName

    },
    aulas (state, aulas){
        state.aulas = aulas;
    },
    tipos (state, tipos){
        state.tipos = tipos;

    },
    equipamientos (state, equipamientos){
      state.equipamientos = equipamientos;

    },
    clearAuthData (state) {
      state.idToken = null
    }

  };
  const actions= {
    login ({commit, dispatch}, authData) {

      axios.post('/login', {
        email: authData.email,
        password: authData.password,

      })
        .then(res => {

            commit('tokenUser', {
                token: res.data.token,

            });
            dispatch('fetchUser');

        })
    },
      logout ({commit}) {
          commit('clearAuthData')
          localStorage.removeItem('token')
          router.replace('/signin')
      },
      reservar ({commit, state},  data) {
            console.log(data)
          axios.post('/reservar.vue', data , {
              headers: { Authorization: `Bearer ${state.idToken}` }
          } )
              .then(res => {

                  const data = [];

                  for (var i = 0 ; i < res.data.aulas.length ; i++){
                      data.push( res.data.aulas[i].nombre);
                  }


                  commit('aulas', data);


                  router.replace('/aulas-disponibles')

              }).catch(error =>{
                console.log(error);

          })
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
      fetchTipos({commit , state}){

        axios.get('/tipos', { headers: { Authorization: `Bearer ${state.idToken}` } })
        .then(res=>{

            const data = [];

            for (var i = 0 ; i < res.data.tipos.length ; i++){
                data.push( res.data.tipos[i].tipo);
            }

            commit('tipos', data);

        })
      },
      fetchEquipamiento({commit , state}){

          axios.get('/equipamiento', { headers: { Authorization: `Bearer ${state.idToken}` } })
              .then(res=>{

                  const data = [];

                  for (var i = 0 ; i < res.data.equipamientos.length ; i++){
                      data.push( res.data.equipamientos[i].nombre);
                  }

                  commit('equipamientos', data);

              })
      }

  };
  const getters = {
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
      },
      getEquipamientosAula(state) {

          return state.equipamientos;
      },
      getAulas(state) {

          return state.aulas;
      }

  };

export default new Vuex.Store({
    state,
    getters,
    actions,
    mutations,
})