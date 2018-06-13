
<template>
    <div>
    <h1>Reservas</h1>
        <vue-event-calendar :events="reservas">
            <template :title="title" slot-scope="props">
                <div v-for="(event, index) in props.showEvents" class="event-item">
                    <div @click="openDrawer(event)" class="reserva">
                        {{event.title}} <br> {{event.date}} -> {{event.hora}}º {{event.turno}}
                    </div>


                </div>
            </template>
        </vue-event-calendar>

        <md-button @click="$emit('new')"
                    class="md-fab md-primary add">
            <md-icon>add</md-icon>
        </md-button>
        <md-drawer v-if="showSidepanel" class="md-right" :md-active.sync="showSidepanel">
            <md-toolbar class="md-transparent" md-elevation="0">
                <h1 class="drawerTitle">{{this.SelectReserva.title}}</h1>
            </md-toolbar>

            <md-list>
                <md-list-item>
                    <span class="md-list-item-text">Fecha : {{this.SelectReserva.date}}</span>
                    <md-icon class="md-primary">date_range</md-icon>
                </md-list-item>

                <md-list-item>
                    <span class="md-list-item-text">Turno : {{this.SelectReserva.turno}}</span>
                    <md-icon class="md-primary">invert_colors</md-icon>
                </md-list-item>

                <md-list-item>
                    <span class="md-list-item-text">Hora: {{this.SelectReserva.hora}}º hora</span>
                    <md-icon class="md-primary">alarm</md-icon>
                </md-list-item>

                <md-list-item>
                    <span class="md-list-item-text">Aforo: {{this.SelectReserva.aforo}} personas</span>
                    <md-icon class="md-primary">accessibility</md-icon>
                </md-list-item>
            </md-list>
            <md-divider></md-divider>
            <br>

            <md-button @click="active = true"
                    class="md-icon-button md-raised md-accent"
                    style="width: 100px; height: 100px; margin-left: 37%">
            <md-icon class="md-size-3x" >cancel</md-icon>
            </md-button>

        </md-drawer>
        <div>
            <md-dialog-confirm
                    :md-active.sync="active"
                    md-title="¿ Desea cancelar la reserva?"
                    md-content="Es posible que si cancela la reserva su aula por defecto para esa hora no este disponible."
                    md-confirm-text="SI"
                    md-cancel-text="NO"
                    @md-confirm="onConfirm" />

        </div>
        <md-snackbar   :md-active.sync="showSnackbar" md-persistent>
            <span>Reserva Cancelada correctamente</span>
            <md-button class="md-primary" @click="showSnackbar = false">cerrar</md-button>
        </md-snackbar>
    </div>
</template>

<script>
    import {mapState} from 'vuex';
    import axios from 'axios'
    export default {
        name: 'app',
        data () {
            return {
                title: 'Reservas pendientes',
                showSidepanel: false,
                showSnackbar:false,
                SelectReserva: {
                    date: null,
                    title: null,
                    hora:null,
                    turno:null,
                    aforo:null,
                    id:null,
                },
                active: false,


            }
        },
        computed: {
            ...mapState(['reservas'])
        },

        methods: {

            openDrawer(event){
                this.SelectReserva.date = event.date;
                this.SelectReserva.title = event.title;
                this.SelectReserva.hora = event.hora;
                this.SelectReserva.turno = event.turno;
                this.SelectReserva.aforo = event.aforo;
                this.SelectReserva.id = event.id;
                this.showSidepanel = true;
            },
            onConfirm () {

                 var _self  = this;
                axios.delete('/reservas/'+ this.SelectReserva.id, {

                    headers: {Authorization: `Bearer `+ this.$store.getters.getToken}
                })
                    .then(res => {
                        console.log(res)
                        _self.showSidepanel=false;
                        _self.$store.dispatch('fetchReservas');
                        _self.showSnackbar = true;
                    })
                    .catch(error => console.log(error))


            },
        }
    }
</script>

<style scoped>

    h1, h2, h3 {
        font-weight: normal;
        margin: 0;
        padding: 0;
    }
    ul {
        list-style-type: none;
        padding: 0;
    }
    li {
        display: inline-block;
        margin: 0 10px;
    }
    a {
        color: #42b983;
    }
    .t-center{
        text-align: center;
        margin: 20px;
    }
    .md-toolbar{
        background:  url('data:image/png;base64,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');
        height: 200px;
    }
    .reserva:hover{
        background-color: lightgray;
    }

    .drawerTitle{
        color: white;
        font-size: 590%;
        margin: 10% 20% 10% 15%;
    }

    .add{
        position: fixed; padding: 10px;  bottom: 8%; right: 8%;
    }



    @media (min-width : 600px) and (max-width: 767px) {
        .add {
            position: absolute;
            top:88%;
            left: 80%;
        }
    }
    @media  (max-width: 599px) {
        .add {
            position: absolute;
            top:88%;
            left: 68%;
        }
    }
    @media  (min-width: 769px) and (max-width: 1450px) {
        .add {
            position: absolute;
            top:83%;
            left: 85%;

        }
    }

    @media  (min-width: 1451px)and (max-width: 1700px){
        .add {
            position: absolute;
            top:83%;
            left: 79%;

        }
    }
</style>