<template>
    <div class="page-container">
        <md-app md-mode="reveal">
            <md-app-toolbar class="md-primary">
                <md-button class="md-icon-button" @click="menuVisible = !menuVisible">
                    <md-icon>menu</md-icon>
                </md-button>
                <span class="md-title">Reserva tu aula</span>
            </md-app-toolbar>

            <md-app-drawer :md-active.sync="menuVisible">
                <md-toolbar class="md-transparent" style="background-color: #81b0ff; min-height: 144px" md-elevation="0">
                    <md-avatar class="md-avatar-icon md-large md-accent" style="margin-top: 10px">
                        <md-ripple>MM</md-ripple>
                    </md-avatar>
                    <div style="padding: 20px">

                     <span class="md-title" style="color:#ffffff">Bienvenido</span>
                     <span class="md-display-1" style="color:#fff0ff" >{{this.$store.getters.getUserName}}</span>
                    </div>
                </md-toolbar>

                <md-list>
                    <md-list-item>
                        <md-icon>date_range</md-icon>
                        <span class="md-list-item-text">Reservar</span>
                    </md-list-item>

                    <md-list-item>
                        <md-icon>account_box</md-icon>
                        <span class="md-list-item-text">Perfil de Usuario</span>
                    </md-list-item>

                    <md-list-item>
                        <md-icon>open_in_new</md-icon>
                        <span class="md-list-item-text">Salir</span>
                    </md-list-item>


                </md-list>
            </md-app-drawer>

            <md-app-content>

                <component :is="mode"></component>

            </md-app-content>
        </md-app>
    </div>
</template>


<script>
    import Reservar from './pages/reservar'
    import router from '../../router'
    export default {
        name: 'Reveal',
        data: () => ({
            menuVisible: false,
            mode: 'app-reservar',
        }),
        components:{
            appReservar : Reservar,
        },
        beforeCreate() {

            if(!this.$store.getters.isAuthenticated){
                router.replace('/')

            }else {
                this.$store.dispatch('fetchTipos');
                this.$store.dispatch('fetchEquipamiento');
            }
        },

    }
</script>

<style lang="scss" scoped>
    .md-app {
        min-height : 100vh;
        border: 1px solid rgba(#000, .12);
    }
    .md-app-content{
        background-color: #cdcece;
    }
    // Demo purposes only
    .md-drawer {
        width: 230px;
        max-width: calc(100vw - 125px);
    }

</style>
