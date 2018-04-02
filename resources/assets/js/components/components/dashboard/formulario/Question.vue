<template>
    <div >
        <div class="panel panel-default" v-for="(pregunta , index) of question" v-if="pregunta.respondida">
            <div class="panel-heading">
                <h3 class="panel-title text-center">{{ pregunta.pregunta }}</h3>
            </div>
            <div class="panel-body" v-if="countQuestion != 0" >
                <div class="col-xs-12 col-sm-6 text-center"  v-for="respuesta of pregunta.respuesta">
                    <button class="btn btn-primary btn-lg" style="margin: 10px" @click="responder(respuesta)">{{ respuesta }}</button>
                </div>
            </div>
            <div class="panel-body" v-else>
                <div class="col-xs-12 col-sm-6 text-center"  >
                    <input type="date" v-model="dia" placeholder="selecciona el dia">
                    <button class="btn btn-primary btn-lg" style="margin: 10px" @click="responder(dia)">Siguiente</button>

                </div>

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
                        respuesta: []

                    },
                    {
                        pregunta: 'Seleccione el turno ',
                        respondida : false,
                        respuesta: ['Mañana' ,  'Tarde' ]

                    },
                    {
                        pregunta: 'Seleccione la hora ',
                        respondida : false,
                        respuesta: ['1º hora' ,  '2º hora' , '3º hora' , '4º hora' , '5º hora' , '6º hora']

                    },
                    {
                        pregunta: 'Seleccione el numero de sitios necesarios',
                        respondida : false,
                        respuesta: ['Menos de 10' ,  'menos de 20' , 'menos de 30' , ' mas de 30 ']

                    },
                    {
                        pregunta: 'Seleccione el tipo de aula requerida',
                        respondida : false,
                        respuesta: this.$store.getters.getTiposAula,
                    },
                    {
                        pregunta: 'Seleccione otros requerimientos' ,
                        respondida: false,
                        respuesta: ['requ1' ,  'req2' , 'req3']
                    },
                ],
                countQuestion: 0,
                dia: null,
                respuestas: [],
            };
        },
        methods: {
            responder(respuesta) {
                this.question[this.countQuestion].respondida = false;
                this.countQuestion++;
                this.respuestas.push(respuesta);
                if(this.countQuestion >= this.question.length){
                    console.log(this.respuestas)
                    this.$emit('answered', false);
                }else {
                    this.$emit('answered', true);
                }

            }
        },
        
        activated(){

            this.question[this.countQuestion].respondida = true;
        },

    }
</script>
