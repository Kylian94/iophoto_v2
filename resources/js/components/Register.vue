<template>
        <div class="container">

            <v-container class="full-height">
                <v-layout justify-center mb-2>
                    <v-flex md4>
                        <v-layout justify-center>
                            <v-flex xs2 sm2 md2 mb-3>
                                <v-img  src="/img/logo_dark.png"></v-img>
                            </v-flex>
                        </v-layout>
                        <v-layout justify-center>
                            <h1>Welcome to IO.Photo</h1>
                        </v-layout>
                        <v-layout justify-center my-4>
                            <div class="fb-login-button" data-size="large" data-button-type="continue_with" data-auto-logout-link="false" data-use-continue-as="false" ma-auto></div>
                        </v-layout>
                        <hr>
                        <p>ou inscrivez-vous directement sur IO.Photo</p>
                    </v-flex>
                </v-layout>



                <v-form>
                    <input type="hidden" name="_token" :value="csrf">
                    <v-layout justify-center>
                        <v-flex xs12 sm12 md4  ma-2>
                            <h2>S'inscrire</h2>
                            <v-flex column grey darken-3 pa-4>
                                <v-text-field dark
                                label="Pseudo" v-validate="'required'" v-model="name" name="name" required autofocus
                                ></v-text-field>
                                <p class="teal--text text--lighten-3 subheading" v-if="errors.has('name')">⚠️ {{ errors.first('name') }}</p>
                                
                            
                                <v-text-field dark
                                id="email" label="Email"  v-validate="'required|email'" name="email" v-model="email" required
                                ></v-text-field>
                                 <p class="teal--text text--lighten-3 subheading" v-if="errors.has('email')">⚠️ {{ errors.first('email') }}</p>
                                

                                <v-text-field dark
                                id="password" type="password" v-validate="'required|min:8'" label="Mot de passe" v-model="password"  name="password" required
                                ></v-text-field>
                                <p class="teal--text text--lighten-3 subheading" v-if="errors.has('password')">⚠️ {{ errors.first('password') }}</p>
                                

                                <v-text-field dark
                                id="password-confirm" v-validate="'required'" label="Confirmation mot de passe" v-model="password_confirmation" type="password" class="" name="password_confirmation" required
                                ></v-text-field>
                                <p class="teal--text text--lighten-3 subheading" v-if="errors.has('password_confirmation')">⚠️ {{ errors.first('password_confirmation') }}</p>
                                
                            </v-flex>
                            <v-layout justify-center>
                                <v-btn dark type="submit" color="teal darken-1" @click="handleSubmit">S'inscrire</v-btn>
                            </v-layout>
                            <hr>
                            <p>Si vous avez déjà un compte, connectez-vous : <router-link :to="{ name: 'login' }"> ici </router-link></p>  
                        </v-flex>
                    </v-layout>
                </v-form>
            </v-container>
            <div id="fb-root"></div>  


            <!-- <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card card-default">
                        <div class="card-header">Register</div>
                        <div class="card-body">
                            <form>
                                <input type="hidden" name="_token" :value="csrf">
                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>
                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control" v-model="name" required autofocus>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control" v-model="email" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control" v-model="password" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm Password</label>
                                    <div class="col-md-6">
                                        <input id="password-confirm" type="password" class="form-control" v-model="password_confirmation" required>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary" @click="handleSubmit">
                                            Register
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>
    </template>
    <script>
    export default {
        props : ['nextUrl'],
        data(){
            return {
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                name : "",
                email : "",
                password : "",
                password_confirmation : ""
            }
        },
        methods : {
            handleSubmit(e) {
                e.preventDefault()
                if (this.password !== this.password_confirmation || this.password.length <= 0) {
                    this.password = ""
                    this.password_confirmation = ""
                    return alert('Passwords do not match')
                }
                let name = this.name
                let email = this.email
                let password = this.password
                let c_password = this.password_confirmation
                axios.post('api/register', {name, email, password, c_password}).then(response => {
                    let data = response.data
                    localStorage.setItem('IophotoStore.user', JSON.stringify(data.user))
                    localStorage.setItem('IophotoStore.jwt', data.token)
                    if (localStorage.getItem('IophotoStore.jwt') != null) {
                        this.$emit('loggedIn')

                        var currentUser = JSON.parse(localStorage.getItem('IophotoStore.user'));
                        swal.fire({
                                                title: "Register with Success",
                                                text: "Welcome " + currentUser.name + " !",
                                                type: "success",
                                            }).then(function () {

                                            }.bind(this)).catch(errors => {});
                        let nextUrl = this.$route.params.nextUrl
                        this.$router.push((nextUrl != null ? nextUrl : '/'))
                    }
                })
            }
        }
    }
    </script>