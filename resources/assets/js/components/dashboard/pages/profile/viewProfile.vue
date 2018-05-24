<template>
    <div>
        <md-dialog :md-active.sync="showDialog">
            <md-card>
                <md-card-media>

                    <div class="perfil">

                        <md-avatar class="md-large">


                        </md-avatar>
                        <div style="float: right">
                            <button @click="edit"><i class="material-icons" style="color: white">create</i></button>
                            <button @click="back"><i class="material-icons" style="color: white">undo</i></button>


                        </div>

                        <div>
                            <span class="md-display-1">{{user.name}} </span>
                            <br>
                            <span class="md-title" style="color:white">{{user.email}}</span>
                        </div>
                    </div>
                </md-card-media>

                <md-card-content>


                    <md-list class="md-double-line md-dense">
                        <md-list-item>
                            <md-icon class="md-primary">group</md-icon>
                            <div class="md-list-item-text">
                                <span>{{user.name}}</span>
                                <span>name</span>
                            </div>
                        </md-list-item>

                        <md-divider class="md-inset"></md-divider>

                        <md-list-item>
                            <md-icon class="md-primary">email</md-icon>
                            <div class="md-list-item-text">
                                <span>{{user.email}}</span>
                                <span>email</span>
                            </div>
                        </md-list-item>
      

                    </md-list>


                </md-card-content>
            </md-card>

        </md-dialog>

    </div>
</template>

<script>
    import router from '../../../../router';
    export default {
        name: 'DialogCustom',
        data: () => ({
            showDialog: true
        }),
        props: ['user'],
        methods: {
            edit() {
                this.$emit('edit');
            },
            back() {
                router.replace('/dashboard')
                this.showDialog = false;

            }
        }
    }
</script>

<style lang="scss" scoped>

    .md-dialog {
        min-width: 290px;

    }

    .perfil {
        background: #C5D639;
        padding: 30px;
    }

    @media (min-width: 600px) and (max-width: 1030px) {
        .md-dialog {
            margin-left: 22%;
        }
    }

    @media (max-height: 600px) {
        .md-dialog {
            overflow: scroll;
        }
    }

    button {

        background: transparent;
        border: none !important;
        font-size: 0;
    }

</style>
