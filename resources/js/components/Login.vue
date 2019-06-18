 <template>
        <div class="container">
            <v-container class="full-height ">


                <v-layout justify-center mb-4>
                    <v-flex md5>
                        <v-layout justify-center>
                            <v-flex xs2 sm2 md2 mb-3>
                                <v-img  src="/img/logo_dark.png"></v-img>
                            </v-flex>
                        </v-layout>
                        <v-flex column ma-2>
                            <v-layout justify-center>
                                <h1 mb-5>Welcome to IO.Photo</h1>
                            </v-layout>
                            <v-layout justify-center my-4>
                                <div class="fb-login-button" data-size="large" data-button-type="login_with" data-auto-logout-link="false" data-use-continue-as="false" m-auto></div>
                            </v-layout>
                            <hr>
                            <p>ou connectez-vous avec votre compte IO.Photo</p>
                        </v-flex>
                    </v-flex>
                    
                </v-layout>

                <form>
                    <input type="hidden" name="_token" :value="csrf">
                    <v-layout justify-center>
                        <v-flex xs12 sm12 md5 ma-2>
                            <h2>Se connecter</h2>
                            <v-flex column grey darken-3 pa-4>
                                
                                <v-text-field dark
                                id="email" type="email" v-model="email" name="email" required autofocus label="Email" v-validate="'required|email'"
                                ></v-text-field>
                                <p class="teal--text text--lighten-3 subheading" v-if="errors.has('email')">⚠️ {{ errors.first('email') }}</p>
                                
                                
                                <v-text-field dark id="password" v-validate="'required'" name="password" type="password" v-model="password" required label="Password"
                                ></v-text-field>
                                <p class="teal--text text--lighten-3 subheading" v-if="errors.has('password')">⚠️ {{ errors.first('password') }}</p>
                            </v-flex>
                            <v-layout align-center justify-center>
                                <v-btn type="submit" color="teal darken-1" dark @click="handleSubmit">Se connecter</v-btn>
                            </v-layout>
                            <hr>
                        <p>💡 Si vous n'avez pas de compte, créez votre compte : <router-link :to="{ name: 'register' }">  ici </router-link></p>
                        </v-flex>
                    </v-layout>
                </form>
            </v-container>
            <div id="fb-root"></div>
        </div>
    </template>
    <script>
        export default {
            data() {
                return {
                    csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    email: "",
                    password: "",
                    
                }
            },
            methods: {
                handleSubmit(e) {
                    e.preventDefault()
                    if (this.password.length > 0) {
                        let email = this.email
                        let password = this.password

                        axios.post('api/login', {email, password}).then(response => {
                            let user = response.data.user
                            let is_admin = user.is_admin
                            let carts = []

                            localStorage.setItem('IophotoStore.user', JSON.stringify(user))
                            localStorage.setItem('IophotoStore.carts', carts)
                            localStorage.setItem('IophotoStore.jwt', response.data.token)

                            if (localStorage.getItem('IophotoStore.jwt') != null) {
                                this.$emit('loggedIn')
                                var currentUser = JSON.parse(localStorage.getItem('IophotoStore.user'));
                                if (this.$route.params.nextUrl != null) {
                                    this.$router.push(this.$route.params.nextUrl)
                                    
                                    swal.fire({
                                                title: "Login Success",
                                                text: "Welcome " + currentUser.name + " !",
                                                type: "success",
                                            }).then(function () {

                                            }.bind(this)).catch(errors => {});
                                } else {
                                    this.$router.push((is_admin == 1 ? 'admin' : '/'))
                                    swal.fire({
                                                title: "Login Success",
                                                text: "Welcome Admin : " + currentUser.name + " !",
                                                type: "success",
                                            }).then(function () {

                                            }.bind(this)).catch(errors => {});
                                }
                            }
                        });
                    }
                }
            }
        }
    </script>
    <style>
    .marginNav {
        margin-top:100px;
    }
    </style>