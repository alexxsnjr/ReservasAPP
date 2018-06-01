<template>
    <component :is="component" :user="user" @view="component = 'app-View'" @back=" $emit('back' )" @edit="component = 'app-Edit'"></component>
</template>
<script>
    import View from './viewProfile.vue'
    import Edit from './editProfile.vue'

    export default {
        data: () => ({
            component: 'app-View',
        }),
        props: ['user'],
        components: {
            appView: View,
            appEdit: Edit


        },

    }
</script>
