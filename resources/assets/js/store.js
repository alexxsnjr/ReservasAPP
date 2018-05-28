import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'


import router from './router'

Vue.use(Vuex)


const state = {
    idToken: null,
    user :{
        email: null,
        name : null,
        id : null,
    },
    aulas: null,
    tipos: [],
    equipamientos: [],
    reservas:[],
};
const mutations = {
    tokenUser(state, userData) {
        state.idToken = userData.token

    },
    authUser(state, userData) {
        state.user.id= userData.userID,
        state.user.name = userData.userName
        state.user.email = userData.userEmail
    },

    aulas(state, aulas) {
        state.aulas = aulas;
    },
    tipos(state, tipos) {
        state.tipos = tipos;

    },
    equipamientos(state, equipamientos) {
        state.equipamientos = equipamientos;

    },
    clearAuthData(state) {
        state.idToken = null
        state.aulas = null
        state.tipos = []
        state.equipamientos = []

    },
    reservas(state , reservas){
        state.reservas = reservas;
    }

};
const actions = {
    login({commit, dispatch}, authData) {

        axios.post('/login', {
            email: authData.email,
            password: authData.password,

        })
            .then(res => {

                if(res.data.token){
                    commit('tokenUser', {
                        token: res.data.token,

                    });
                }else{
                    commit('tokenUser', {
                        token: 'error',

                    });
                }

                dispatch('fetchUser');


            })
    },
    logout({commit}) {
        commit('clearAuthData')
        localStorage.removeItem('token')
        router.replace('/signin')
    },
    reservar({commit, state}, data) {
        console.log(data)
        axios.post('/reservar', data, {
            headers: {Authorization: `Bearer ${state.idToken}`}
        })
            .then(res => {
                console.log(res)
                commit('aulas', res.data.aulas);



            }).catch(error => {
            console.log(error);

        })
    },
    doReserva({commit, state, dispatch}, data) {
        axios.post('/doreserva', data, {
            headers: {Authorization: `Bearer ${state.idToken}`}
        })
            .then(res => {
                console.log(res)
                state.aulas = []
                dispatch('fetchReservas');



            }).catch(error => {
            console.log(error);

        })
    },
    updateUser({state} , data){

        axios.put('/user/'+state.user.id, data, {
            headers: {Authorization: `Bearer ${state.idToken}`}
        }).then(res =>{
            console.log(res)
        }).catch(error => console.log(error))
    },
    fetchUser({commit, state , dispatch}) {


        if (!state.idToken) {

            return

        }
        axios.get('/user/'+ state.idToken, {
            headers: {Authorization: `Bearer ${state.idToken}`}
        })
            .then(res => {

                commit('authUser', {
                    userID: res.data.user.id,
                    userName: res.data.user.name,
                    userEmail: res.data.user.email,
                })
                router.replace('/dashboard')
                dispatch('fetchReservas');
            })
            .catch(error => console.log(error))

    },
    fetchTipos({commit, state}) {

        axios.get('/tipos', {headers: {Authorization: `Bearer ${state.idToken}`}})
            .then(res => {

                const data = [];

                for (var i = 0; i < res.data.tipos.length; i++) {
                    data.push(res.data.tipos[i].tipo);
                }

                commit('tipos', data);

            })
    },
    fetchEquipamiento({commit, state}) {

        axios.get('/equipamiento', {headers: {Authorization: `Bearer ${state.idToken}`}})
            .then(res => {

                const data = [];

                for (var i = 0; i < res.data.equipamientos.length; i++) {
                    data.push(res.data.equipamientos[i].nombre);
                }

                commit('equipamientos', data);

            })
    },
    fetchReservas({commit, state}){

        axios.get('/reservas/'+ state.user.id, {

            headers: {Authorization: `Bearer ${state.idToken}`}
        })
            .then(res => {
                console.log('reservas')
                console.log(res.data)
                const data = [];
                for (var i = 0; i < res.data.reservas.length; i++) {
                    data.push({
                        title: res.data.reservas[i].nombre,
                        date: res.data.reservas[i].fecha,
                        hora: res.data.reservas[i].hora,
                        turno: res.data.reservas[i].turno,
                        aforo: res.data.reservas[i].aforo,
                    })
                }

                commit('reservas', data);
            })
            .catch(error => console.log(error))

    }

};
const getters = {

    getToken(state){
      return state.idToken
    },

    isAuthenticated(state) {
        if (state.idToken !== null) {
            return true;
        } else {
            return false;
        }
    },
    getUser(state) {
        return state.user;
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