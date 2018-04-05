<template>
      <div >
        <div class="panel panel-default" v-for="(pregunta , index) of question" v-if="pregunta.respondida">
            <div class="panel-heading">
                <h3 class="panel-title text-center">{{ pregunta.pregunta }}</h3>
            </div>
            <div class="panel-body" v-if="countQuestion == 0">
                <div class="col-xs-12 col-sm-6 text-center"  >
                    <input type="date" v-model="dia" placeholder="selecciona el dia">
                    <button class="btn btn-primary btn-lg" style="margin: 10px" @click="responder(dia , pregunta.nombre)">Siguiente</button>

                </div>

            </div>
            <div class="panel-body" v-if="countQuestion > 0 && countQuestion < 5" >
                <div class="col-xs-12 col-sm-6 text-center"  v-for="respuesta of pregunta.respuesta">
                    <button class="btn btn-primary btn-lg" style="margin: 10px" @click="responder(respuesta , pregunta.nombre)">{{ respuesta }}</button>
                </div>
            </div>

            <div class="panel-body" v-if="countQuestion == 5">
                <div class="col-xs-12 col-sm-6 text-center"  v-for="respuesta of pregunta.respuesta">

                    <input type="checkbox" :id="respuesta" :value="respuesta" v-model="equipamientos">
                    <label :for="respuesta">{{ respuesta }}</label>
                </div>
                <button class="btn btn-primary btn-lg" style="margin: 10px" @click="responder(this.equipamientos , pregunta.nombre)">Siguiente</button>


            </div>

        </div>
    </div>

</template>
<style>

</style>
<script>

    export default{
        data() {
            return {
                question: [
                    {
                        pregunta: 'Seleccione el Dia de la reserva',
                        respondida : false,
                        nombre: 'dia',
                        respuesta: []

                    },
                    {
                        pregunta: 'Seleccione el turno ',
                        respondida : false,
                        nombre: 'turno',
                        respuesta: ['Mañana' ,  'Tarde' ]

                    },
                    {
                        pregunta: 'Seleccione la hora ',
                        respondida : false,
                        nombre: 'hora',
                        respuesta: ['1º hora' ,  '2º hora' , '3º hora' , '4º hora' , '5º hora' , '6º hora']

                    },
                    {
                        pregunta: 'Seleccione el numero de sitios necesarios',
                        respondida : false,
                        nombre: 'aforo',
                        respuesta: ['Menos de 10' ,  'menos de 20' , 'menos de 30' , ' mas de 30 ']

                    },
                    {
                        pregunta: 'Seleccione el tipo de aula requerida',
                        respondida : false,
                        nombre: 'tipo',
                        respuesta: [],
                    },
                    {
                        pregunta: 'Seleccione otros requerimientos' ,
                        respondida: false,
                        nombre: 'equipamiento',
                        respuesta: [],
                    },
                ],
                countQuestion: 0,
                dia: null,
                equipamientos: [],
                formData: {},

            };
        },
        methods: {
            responder(respuesta , nombre) {

                this.question[this.countQuestion].respondida = false;

                switch(nombre) {
                    case "dia":
                        this.formData.dia = respuesta;
                        break;
                    case "turno":
                        this.formData.turno = respuesta;
                        break;
                    case "hora":
                        this.formData.hora = respuesta;
                        break;
                    case "aforo":
                        this.formData.aforo = respuesta;
                        break;
                    case "tipo":
                        this.formData.tipo = respuesta;
                        break;
                    case "equipamiento":
                        this.formData.equipamiento = this.equipamientos;
                        break;


                }

                this.countQuestion++;
                console.log(this.formData)
                if(this.countQuestion >= this.question.length){
                    this.$store.dispatch('reservar' , this.formData)
                    this.$emit('answered', false);
                }else {

                    this.$emit('answered', true);
                }

            }
        },
        
        activated(){
            console.log(this.countQuestion);
            this.question[this.countQuestion].respondida = true;

            if(this.countQuestion >= 4){
                this.question[4].respuesta = this.$store.getters.getTiposAula;
                this.question[5].respuesta = this.$store.getters.getEquipamientosAula;
            }
        },

    }
</script>
