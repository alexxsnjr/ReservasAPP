<template>
  <div>
    <md-dialog :md-active.sync="showDialog">
        <md-card>
            <md-card-media >
                
                <div class="perfil">
                    
                    <div class="top-bar">
                         <button @click="back"><i class="material-icons">keyboard_backspace</i></button>
                        <div>
                            <button @click="done"><i class="material-icons" >done</i></button>
                            <button  @click="activeChangePassword = true"><i class="material-icons" >more_vert</i></button>
                            
                        </div>
                    </div>
                   
                </div>
            </md-card-media>

            <md-card-content>
                

                    <md-list class="md-double-line md-dense">
                        <md-list-item>
                            <md-icon class="md-primary">group</md-icon>
                            <div class="md-list-item-text">

                                <md-field>
                                    <label>Full name</label>
                                    <md-input v-model="user.name" autofocus></md-input>
                                </md-field>
                                
                            </div>
                        </md-list-item>

                        <md-divider class="md-inset"></md-divider>

                         <md-list-item>
                            <md-icon class="md-primary">phone</md-icon>
                            <div class="md-list-item-text">
                                <md-field>
                                    <label>Phone</label>
                                    <md-input v-model="user.phone" ></md-input>
                                </md-field>
                            </div>
                        </md-list-item>

                        <md-divider class="md-inset"></md-divider>

                        <md-list-item>
                            <md-icon class="md-primary">email</md-icon>
                            <div class="md-list-item-text">
                                 <md-field>
                                    <label>Email</label>
                                    <md-input v-model="user.email" type="email" ></md-input>
                                </md-field>
                            </div>
                        </md-list-item>

                        <md-divider class="md-inset"></md-divider>

                        <md-list-item>
                            <md-icon class="md-primary">location_on</md-icon>
                            <div class="md-list-item-text">
                                
                                <md-field>
                                    <label>Street</label>
                                    <md-input v-model="user.address.c" type="text" ></md-input>
                                </md-field>
                                
                                 <md-field>
                                    <label>City</label>
                                    <md-input v-model="user.address.m" type="text" ></md-input>
                                </md-field>
                                 <md-field>
                                    <label>Country</label>
                                    <md-input v-model="user.address.p" type="text" ></md-input>
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
          <md-input v-model="password.old"  type="password"></md-input>
        </md-field>

        <md-field :md-toggle-password="false">
          <label>New Password</label>
          <md-input v-model="password.new"  type="password"></md-input>
        </md-field>

        <md-field :md-toggle-password="false">
          <label>Repeat Password</label>
          <md-input v-model="password.repeat"  type="password"></md-input>
        </md-field>
     

        <md-dialog-actions>
            <md-button  @click="cancel" class="md-dense md-primary">CANCEL</md-button>
            <md-button  @click="activeChangePassword = false" class="md-dense md-primary">CHANGE</md-button>
        </md-dialog-actions>
      </div>
    
    </md-dialog>
        
    </div>

  </div>
</template>

<script>
  export default {
    name: 'DialogCustom',
    data: () => ({
      showDialog: true,
      activeChangePassword: false,
      password: {
          old:'',
          new: '',
          repeat: '',
      },
    }),
    props: ['user'],
      methods: {
        back() {
             this.$emit('view');
        },
        done() {
            // codigo peticion ajax;
            this.back();
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
   
    @media  (max-height: 670px) {
        .md-dialog {
                overflow-y: scroll;
        }
    }
    button {

        background: transparent;
        border: none !important;
        font-size:0;
    }
    .top-bar{
        background-color: lightblue;
        padding-top:10px;
        
        
    }

    .top-bar div{
       float: right;  
        
    }

    .md-card-content{
        max-width: 300px;
    }
    .iconPhoto{
        position: absolute;
        left: 85%;
        top:90%;
    }
    
    .FormPassword{
        padding:15px;
    }
</style>
