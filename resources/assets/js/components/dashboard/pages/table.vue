<template>
    <vue-event-calendar :events="demoEvents"></vue-event-calendar>
</template>

<script>
    export default {
        data () {
            return {
                demoEvents: [{
                    date: '2018/04/12', // Required
                    title: 'Aula A01' // Required
                }, {
                    date: '2018/04/21',
                    title: 'Aula B01',
                    desc: 'Aula de taller para los niños de primero',
                    customClass: 'disabled highlight' // Custom classes to an calendar cell
                }]
            }
        }
    }
</script>