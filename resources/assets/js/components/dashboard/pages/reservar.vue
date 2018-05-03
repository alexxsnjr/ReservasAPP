<template>
    <div>
        <div class="center" style="background: white; padding: 50px 10px 50px 10px" v-if="aulas">
            <md-content class="md-elevation-3">
                <div>

                    <span class="md-display-2">Aulas Disponibles</span><br><br>
                    <button v-for="aula of aulas" class="button" @click="reservar(aula.ID)">{{aula.nombre}}</button>

                </div>
                <br><br>
                <span class="md-caption">
                Seleccione un aula para hacer la reserva, en el dia y la hora Seleccionado anteriormente
            </span>
            </md-content>
        </div>
        <div v-else>
            <md-steppers :md-active-step.sync="active" md-vertical md-linear>
                <md-step id="primer" md-label="Dia" :md-done.sync="primer">
                    <md-content class="md-elevation-20">
                        <div>
                            <span class="md-display-2">Seleccione el dia de la reserva</span>
                            <md-datepicker v-model="formData.fecha">

                            </md-datepicker>
                        </div>
                        <md-button class="md-raised md-primary" @click="setDone('primer', 'segundo')"
                                   v-if="formData.fecha ">Continue
                        </md-button>
                    </md-content>
                </md-step>

                <md-step id="segundo" md-label="Turno" :md-done.sync="segundo">
                    <md-content class="md-elevation-20">
                        <div class="center">
                            <span class="md-display-2">Seleccione el turno de la reserva</span>
                            <br><br>
                            <button class="button" @click="setDone('segundo', 'tercer'); formData.turno = 'manana'">
                                Mañana
                            </button>
                            <button class="button" @click="setDone('segundo', 'tercer'); formData.turno = 'tarde'">Tarde
                            </button>
                        </div>

                    </md-content>
                </md-step>

                <md-step id="tercer" md-label="Hora" :md-done.sync="tercer">
                    <md-content class="md-elevation-20">
                        <div class="center">
                            <span class="md-display-2">Seleccione la hora de la reserva</span>
                            <br><br>
                            <button class="button" @click="setDone('tercer', 'cuarto');formData.hora = '1'">1º HORA
                            </button>
                            <button class="button" @click="setDone('tercer', 'cuarto');formData.hora = '2'">2º HORA
                            </button>
                            <button class="button" @click="setDone('tercer', 'cuarto');formData.hora = '3'">3º HORA
                            </button>
                            <button class="button" @click="setDone('tercer', 'cuarto');formData.hora = '4'">4º HORA
                            </button>
                            <button class="button" @click="setDone('tercer', 'cuarto');formData.hora = '5'">5º HORA
                            </button>
                            <button class="button" @click="setDone('tercer', 'cuarto');formData.hora = '6'">6º HORA
                            </button>

                        </div>
                    </md-content>
                </md-step>
                <md-step id="cuarto" md-label="Aforo" :md-done.sync="cuarto">
                    <md-content class="md-elevation-20">
                        <span class="md-display-2">Introduzca cuantos sitios necesita</span>
                        <md-field>
                            <md-input v-model="formData.aforo" type="number"></md-input>
                        </md-field>
                        <md-button v-if="formData.aforo " class="md-raised md-primary"
                                   @click="setDone('cuarto', 'quinto')">
                            Continue
                        </md-button>
                    </md-content>
                </md-step>

                <md-step id="quinto" md-label="Tipo" :md-done.sync="quinto">
                    <md-content class="md-elevation-20">
                        <span class="md-display-2">Seleccione el tipo de aula requerida</span>

                        <div class="center" v-for="tipo of tipos">
                            <button class="button" @click="setDone('quinto', 'sexto'); formData.tipo=tipo">{{tipo}}
                            </button>

                        </div>
                        <br>
                    </md-content>
                </md-step>
                <md-step id="sexto" md-label="Requerimientos" md-description="Optional" :md-done.sync="sexto">
                    <md-content class="md-elevation-20">
                        <div class="center">
                            <span class="md-display-2 ">Seleccione el equipamiento </span>
                        </div>
                        <br><br>
                        <div style="display: inline-block" v-for="equipamiento of equipamientos">
                            <md-checkbox v-model="formData.requerimientos" :value="equipamiento">{{equipamiento}}
                            </md-checkbox>

                        </div>

                        <md-button class="md-raised md-primary" @click="setDone('sexto')">Continue</md-button>
                    </md-content>
                </md-step>
            </md-steppers>
        </div>
    </div>
</template>

<script>
    import {mapState} from 'vuex';

    export default {
        name: 'StepperLinear',
        data: () => ({
            active: 'primer',
            primer: false,
            segundo: false,
            tercer: false,
            cuarto: false,
            quinto: false,
            sexto: false,
            formData: {
                fecha: null,
                aforo: "",
                turno: "",
                hora: "",
                tipo: "",
                requerimientos: []
            },


        }),
        methods: {
            setDone(id, index) {

                this[id] = true

                if (index) {
                    this.active = index
                } else {

                    this.$store.dispatch('reservar', {
                        fecha: this.formData.fecha,
                        aforo: this.formData.aforo,
                        turno: this.formData.turno,
                        hora: this.formData.hora,
                        tipo: this.formData.tipo,
                        requerimientos: this.formData.requerimientos,


                    });
                }
            },
            reservar(aula){

                this.$store.dispatch('doReserva', {
                    fecha: this.formData.fecha,
                    aula: aula,
                    turno: this.formData.turno,
                    hora: this.formData.hora,

                });

                this.formData.fecha = null
                this.formData.aforo= ""
                this.formData.turno= ""
                this.formData.hora= ""
                this.formData.tipo= ""
                this.formData.requerimientos = []

            }
        },
        computed: {
            ...mapState(['tipos', 'equipamientos', 'aulas'])
        }


    }
</script>

<style scoped>
    .md-card {
        margin-top: 15px;
    }

    .md-content {
        background: #C5D639;
        padding: 50px;

    }




    .button {
        display: inline-block;
        padding: 15px 25px;
        font-size: 24px;
        cursor: pointer;
        text-align: center;
        text-decoration: none;
        outline: none;
        color: #fff;
        background-color: #0096A4;
        border: none;
        border-radius: 15px;
        box-shadow: 0 9px #999;
    }

    @media (max-width : 439px){
        .md-display-2{
            font-size: 15px;
        }
        button{
            font-size: 15px;
        }
        .md-content {
            background: white;
            padding: 10px;

        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            outline: none;
            color: #fff;
            background-color: #0096A4;
            border: none;
            border-radius: 15px;
            box-shadow: 0 9px #999;
        }
    }
    .button:hover {
        background-color: #0096A4;
    }

    .button:active {
        background-color: #0096A4;
        box-shadow: 0 5px #666;
        transform: translateY(4px);
    }



    .center {
        text-align: center;
        margin-top: 10px;
        margin-bottom: 25px;
    }

</style>
