<template>
  <div class="container">
    <div class="row">
      <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
        <h1 class="text-center">Bienvenido {{this.$store.getters.getUserName}}</h1>
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
        <transition name="flip" mode="out-in">
          <keep-alive>
            <component :is="mode" @answered="answered($event)" @confirmed="mode = 'app-question'"></component>
          </keep-alive>
        </transition>
      </div>
    </div>
  </div>
</template>

<script>
    import Question from './formulario/Question.vue';
    import Answer from './formulario/Answer.vue';
    import Transit from './formulario/Transit.vue';
    import router from '../../router'


    export default {
      data() {
          return {
              mode: 'app-question',

          }
      },
      methods: {
          answered(isCorrect) {
              if (isCorrect) {
                  this.mode = 'app-transit';
              } else {
                  this.mode = 'app-answer';

              }
          }
      },
      components: {
          appQuestion: Question,
          appAnswer: Answer,
          appTransit: Transit,
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

<style>
  .flip-enter {
    /*transform: rotateY(0deg);*/
  }

  .flip-enter-active {
    animation: flip-in  0.7s ease-out forwards;
  }

  .flip-leave {
    /*transform: rotateY(0deg);*/
  }

  .flip-leave-active {
    animation: flip-out 0s ease-out forwards;
  }

  @keyframes flip-out {
    from {
      transform: rotateY(0deg);
    }
    to {
      transform: rotateY(90deg);
    }
  }

  @keyframes flip-in {
    from {
      transform: rotateY(90deg);
    }
    to {
      transform: rotateY(0deg);
    }
  }
</style>
