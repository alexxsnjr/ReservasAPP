<template>
    <div>
        <md-steppers :md-active-step.sync="active" md-linear>
            <md-step id="primer" md-label="Dia"  :md-done.sync="primer">
                    <div>
                        <span class="md-display-2">Seleccione el dia de la reserva</span>
                        <md-datepicker v-model="formData.fecha">

                        </md-datepicker>
                    </div>
                <md-button class="md-raised md-primary" @click="setDone('primer', 'segundo')">Continue</md-button>
            </md-step>

            <md-step id="segundo" md-label="Turno"  :md-done.sync="segundo">
                <div class="center">
                    <span class="md-display-2">Seleccione el turno de la reserva</span>
                    <br><br>
                    <button class="button" @click="setDone('segundo', 'tercer'); formData.turno = 'mañana'">Mañana</button>
                    <button class="button" @click="setDone('segundo', 'tercer'); formData.turno = 'tarde'">Tarde</button>
                </div>


            </md-step>

            <md-step id="tercer" md-label="Hora"  :md-done.sync="tercer">
                <div class="center">
                    <span class="md-display-2">Seleccione la hora de la reserva</span>
                    <br><br>
                    <button class="button" @click="setDone('tercer', 'cuarto');formData.hora = '1'">1º HORA</button>
                    <button class="button" @click="setDone('tercer', 'cuarto');formData.hora = '2'">2º HORA</button>
                    <button class="button" @click="setDone('tercer', 'cuarto');formData.hora = '3'">3º HORA</button>
                    <button class="button" @click="setDone('tercer', 'cuarto');formData.hora = '4'">4º HORA</button>
                    <button class="button" @click="setDone('tercer', 'cuarto');formData.hora = '5'">5º HORA</button>
                    <button class="button" @click="setDone('tercer', 'cuarto');formData.hora = '6'">6º HORA</button>

                </div>
            </md-step>
            <md-step id="cuarto" md-label="Aforo"  :md-done.sync="cuarto">
                <span class="md-display-2">Seleccione cuantos sitios necesita</span>
                <md-field>
                    <md-input v-model="formData.aforo" type="number"></md-input>
                </md-field>
                <md-button class="md-raised md-primary" @click="setDone('cuarto', 'quinto')">Continue</md-button>
            </md-step>

            <md-step id="quinto" md-label="Tipo"  :md-done.sync="quinto">

                <div class="center" v-for="tipo of tipos">
                <button class="button" @click="setDone('quinto', 'sexto')">{{tipo}}</button>

                </div>
                <br>
            </md-step>
            <md-step id="sexto" md-label="Requerimientos" md-description="Optional" :md-done.sync="sexto">
                <div class="center">
                    <span class="md-display-2 ">Seleccione el equipamiento </span>
                </div>
                <br><br>
                <div style="display: inline-block" v-for="equipamiento of equipamientos">
                    <md-checkbox v-model="formData.requerimientos" :value="equipamiento">{{equipamiento}}</md-checkbox>

                </div>

                <md-button class="md-raised md-primary" @click="setDone('sexto')">Continue</md-button>
            </md-step>
        </md-steppers>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex'

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
            tipos: [],
            equipamientos: [],
            formData: {
                fecha: "",
                aforo:"",
                turno:"",
                hora:"",
                tipo:"",
                requerimientos: []
            }

        }),
        methods: {
            setDone (id, index , finish) {

                this[id] = true

                this.secondStepError = null

                if (index) {
                    this.active = index
                }

                if (finish){
                    
                }

                this.tipos = this.$store.getters.getTiposAula
                this.equipamientos = this.$store.getters.getEquipamientosAula
            },
        },
        /*computed: mapGetters([
            this.tipos = 'getTiposAula',
        ]),*/


    }
</script    >

<style  scoped>
.md-card{
    margin-top: 15px;
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
    background-color: #448aff;
    border: none;
    border-radius: 15px;
    box-shadow: 0 9px #999;
}

.button:hover {background-color: lightblue}

.button:active {
    background-color: lightblue;
    box-shadow: 0 5px #666;
    transform: translateY(4px);
}
.center{
    text-align:center;
    margin-top: 10px;
}
</style>
