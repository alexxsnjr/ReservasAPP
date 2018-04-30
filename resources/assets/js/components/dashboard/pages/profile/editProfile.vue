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


                    <md-list class="md-double-line md-dense">
                        
                        <md-list-item>
                            <md-icon class="md-primary">group</md-icon>
                            <div class="md-list-item-text">

                                <md-field :class="getValidationClass('name')">
                                    <label>Full name</label>
                                    <md-input v-model="user.name" autofocus></md-input>
                                    <span class="md-error" v-if="!$v.user.name.required">The  name is required</span>
                                    <span class="md-error" v-else-if="!$v.user.name.minlength">Invalid  name</span>
                                </md-field>

                            </div>
                        </md-list-item>


                        <md-divider class="md-inset"></md-divider>

                        <md-list-item>
                            <md-icon class="md-primary">email</md-icon>
                            <div class="md-list-item-text">
                                <md-field :class="getValidationClass('email')">
                                    <label>Email</label>
                                    <md-input v-model="user.email" type="email"></md-input>
                                    <span class="md-error" v-if="!$v.user.email.required">The email is required</span>
                                    <span class="md-error" v-else-if="!$v.user.email.email">Invalid email</span>
                                </md-field>
                            </div>
                        </md-list-item>


                    </md-list>


                </md-card-content>
            </md-card>

        </md-dialog>

        <!-- Dialog para cambiar password-->


        <div>
            <md-dialog :md-active.sync="activeChangePassword">
                <md-dialog-title>Change password</md-dialog-title>
                <div class="FormPassword">
                    <md-field :md-toggle-password="false">
                        <label>Old Password</label>
                        <md-input v-model="password.old" type="password"></md-input>
                    </md-field>

                    <md-field :md-toggle-password="false">
                        <label>New Password</label>
                        <md-input v-model="password.new" type="password"></md-input>
                    </md-field>

                    <md-field :md-toggle-password="false">
                        <label>Repeat Password</label>
                        <md-input v-model="password.repeat" type="password"></md-input>
                    </md-field>


                    <md-dialog-actions>
                        <md-button @click="cancel" class="md-dense md-primary">CANCEL</md-button>
                        <md-button @click="activeChangePassword = false" class="md-dense md-primary">CHANGE</md-button>
                    </md-dialog-actions>
                </div>

            </md-dialog>

        </div>

    </div>
</template>

<script>
    import { validationMixin } from 'vuelidate'
    import {
        required,
        email,
        minLength,
        maxLength
    } from 'vuelidate/lib/validators'
    export default {
        mixins: [validationMixin],
        name: 'DialogCustom',
        data: () => ({
            showDialog: true,
            activeChangePassword: false,
            password: {
                old: '',
                new: '',
                repeat: '',
            },
        }),
        props: ['user'],
        validations: {
            user: {
                name: {
                    required,
                    minLength: minLength(3)
                },
                email: {
                    required,
                    email
                }
            }
        },
        methods: {
            getValidationClass (fieldName) {
                const field = this.$v.user[fieldName]

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
                    this.$store.dispatch('updateUser', {
                        name : this.user.name,
                        email : this.user.email,
                        id : this.user.id,
                    })
                    this.back();
                }

            },
            cancel() {
                this.activeChangePassword = false
                this.password.old = '';
                this.password.new = '';
                this.password.repeat = '';
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
        background-color: lightblue;
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
