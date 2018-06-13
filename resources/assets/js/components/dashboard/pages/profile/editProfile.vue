<template>
    <div>
        <md-dialog :md-active.sync="showDialog">
            <md-card>
                <md-card-media>

                    <div class="perfil">

                        <div class="top-bar">
                            <button @click="back"><i class="material-icons">keyboard_backspace</i></button>
                            <div>
                                <button @click="done"><i class="material-icons">done</i></button>
                                <button @click="activeChangePassword = true"><i class="material-icons">more_vert</i>
                                </button>

                            </div>
                        </div>

                    </div>
                </md-card-media>

                <md-card-content>


                                <md-field :class="getValidationClass('name')">

                                    <label>Full name</label>
                                    <md-input v-model="usu.name" autofocus></md-input>
                                    <span class="md-error" v-if="!$v.usu.name.required">The  name is required</span>
                                    <span class="md-error" v-else-if="!$v.usu.name.minlength">Invalid  name</span>
                                </md-field>




                        <md-divider class="md-inset"></md-divider>


                                <md-field :class="getValidationClass('email')">
                                    <label>Email</label>
                                    <md-input v-model="usu.email" type="email"></md-input>
                                    <span class="md-error" v-if="!$v.usu.email.required">The email is required</span>
                                    <span class="md-error" v-else-if="!$v.usu.email.email">Invalid email</span>
                                </md-field>






                </md-card-content>
            </md-card>

        </md-dialog>

        <!-- Dialog para cambiar password-->


        <div>
            <md-dialog :md-active.sync="activeChangePassword">
                <md-dialog-title>Change password</md-dialog-title>
                <form novalidate  @submit.prevent="changePassword">
                    <div class="FormPassword">
                        <md-field :md-toggle-password="false" :class="getValidationPassword('old')">
                            <label>Old Password</label>
                            <md-input v-model="password.old"  type="password"></md-input>
                            <span class="md-error" v-if="!$v.password.old.required">La contraseña antigua es requerida</span>
                            <span class="md-error" v-else>Contraseña antigua es incorrecta</span>
                        </md-field>

                        <md-field :md-toggle-password="false" :class="getValidationPassword('new')">
                            <label>New Password</label>
                            <md-input v-model="password.new"  type="password"></md-input>
                        </md-field>

                        <md-field :md-toggle-password="false" :class="getValidationPassword('repeat')">
                            <label>Repeat Password</label>
                            <md-input v-model="password.repeat"  type="password"></md-input>
                        </md-field>


                        <md-dialog-actions>
                            <md-button  @click="cancel" class="md-dense md-primary">CANCEL</md-button>
                            <md-button type="submit"  class="md-dense md-primary">CHANGE</md-button>
                        </md-dialog-actions>
                    </div>
                </form>
            </md-dialog>

        </div>

    </div>
</template>

<script>
    import axios from 'axios'
    import { validationMixin } from 'vuelidate'
    import {
        required,
        email,
        minLength,
        sameAs,
    } from 'vuelidate/lib/validators'
    export default {
        mixins: [validationMixin],
        name: 'DialogCustom',
        data: () => ({
            showDialog: true,
            activeChangePassword: false,
            usu: {
                name : '',
                email: '',
            },
            activeChangePassword: false,
            password: {
                old:'',
                new: '',
                repeat: '',
            },
        }),
        mounted() {
            var stateUsu = this.$store.getters.getUser;
            this.usu.name =  stateUsu.name;
            this.usu.email = stateUsu.email;

        },
        props: ['user'],
        validations: {
            usu: {
                name: {
                    required,
                    minLength: minLength(3)
                },
                email: {
                    required,
                    email,
                    isUnique(email) {
                        if (email === '') return true
                        if(this.usu.email != this.user.email){
                            return axios.get('/checkemail/'+this.usu.email)
                                .then(res => {
                                    return res.data //res.data has to return true or false after checking if the username exists in DB
                                })
                        }else{
                            return true
                        }

                    }
                },
            },
            password: {
                old:{
                    required,
                    isCorrect(old) {
                        let user = this.$store.getters.getUser;
                        let token = this.$store.getters.getToken;
                        if (old === '') return true
                        return axios.post('/checkpassword', {password : this.password.old , email : user.email },{
                            headers: {Authorization: 'Bearer' + token}
                        })
                            .then(res => {

                                return res.data //res.data has to return true or false after checking if the username exists in DB
                            })
                    }
                },
                new:{
                    required,
                    minLength: minLength(6)
                },
                repeat: {
                    required,
                    sameAsnew: sameAs('new')
                },
            },
        },
        watch:{
            showDialog:function () {
                if(this.showDialog == false){
                    this.$emit('back');
                }
            }
        },
        methods: {
            getValidationClass (fieldName) {
                const field = this.$v.usu[fieldName]

                if (field) {
                    return {
                        'md-invalid': field.$invalid && field.$dirty
                    }
                }
            },
            getValidationPassword (fieldName) {
                const field = this.$v.password[fieldName]

                if (field) {
                    return {
                        'md-invalid': field.$invalid && field.$dirty
                    }
                }
            },
            back() {
                this.$emit('view');
            },
            done() {
                this.$v.$touch()

                if (!this.$v.$invalid) {
                    this.user.name = this.usu.name;
                    this.user.email = this.usu.email;
                    this.$store.dispatch('updateUser', {
                        name : this.usu.name,
                        email : this.usu.email,

                    })
                    this.back();
                }

            },
            cancel() {
                this.activeChangePassword = false
                this.password.old = '';
                this.password.new = '';
                this.password.repeat = '';
            },
            changePassword(){

                this.$v.$touch();
                if (!this.$v.password.$invalid) {
                    let token = this.$store.getters.getToken;
                    let user = this.$store.getters.getUser;
                    axios.put('/password/'+user.id, {new : this.password.new , password : this.password.old , email:user.email},{
                        headers: {Authorization: 'Bearer' + token}
                    })

                        .then(function (response) {
                            console.log(response)

                        }).catch(function (error) {
                        console.log(error)
                    })

                    this.activeChangePassword = false
                }
            }
        }
    }
</script>

<style lang="scss" scoped>

    .md-dialog {
        min-width: 290px;

    }

    @media (min-width: 602px) and (max-width: 1030px) {
        .md-dialog {
            margin-left: 20%;
        }
    }

    @media (max-height: 670px) {
        .md-dialog {
            overflow-y: scroll;
        }
    }

    button {

        background: transparent;
        border: none !important;
        font-size: 0;
    }

    .top-bar {
        background-color: #C5D639;
        padding-top: 10px;

    }

    .top-bar div {
        float: right;

    }

    .md-card-content {
        max-width: 300px;
    }

    .iconPhoto {
        position: absolute;
        left: 85%;
        top: 90%;
    }

    .FormPassword {
        padding: 15px;
    }
</style>
