<template>
    <div class="box-center">
        <div class="row">
            <div class="col-xs-12 col-sm-8 col-sm-2 col-md-6 col-md-3 center">
                <div class="card ">
                    <div class="card-header col-xs-12 col-sm-6 center">
                        <h3 class="panel-title text-justify">Aulas disponibles</h3>
                    </div>
                    <div class="card-body">
                        <div class="col-xs-12 col-sm-6 center" v-for="aula in aulas" >
                            <button class="btn btn-primary btn-sm" style="margin: 10px" >{{aula}}</button>

                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
</template>
<script>

    export default{

        data() {
          return {
            aulas : [],
          }
        },
        methods: {


        },
        mounted(){
            this.aulas = this.$store.getters.getAulas;
            console.log(this.aulas)
        }

    }
</script>
<style>
    .box-center {
        margin: 30px auto;
        border: 1px solid #eee;
        padding: 20px;
        box-shadow: 0 2px 3px #ccc;
    }
    
    .center {
        margin: auto;
    }
</style>