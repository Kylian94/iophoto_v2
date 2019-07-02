<template>
    <main>
        <v-flex column>

            <v-layout class="full-height" dark grey darken-3 align-center justify-space-between fill-height wrap>
                <v-flex xs12 sm12 md6 pl-4 ml-4>
                    <h1 class="display-4 font-weight-black white--text hidden-sm-and-down " data-aos="fade-right" data-aos-delay="1000"
                        data-aos-duration="1500">LOREM IPSUM ABEBAT ERATUM</h1>
                    <h1 class="display-1 font-weight-black white--text hidden-sm-and-up ">LOREM IPSUM ABEBAT ERATUM</h1>
                        <v-btn class="font-weight-bold large " data-aos="flip-up" data-aos-delay="2500"
                        data-aos-duration="1000" dark color="teal darken-1" href="#scrollBot" v-smooth-scroll="{ duration: 1000, offset: -130}"> DÉCOUVRIR </v-btn>
                </v-flex>
                <v-flex xs12 sm12 md5>
                    <v-img data-aos="fade-left" data-aos-delay="2000" data-aos-duration="1500" src="/img/appareil_home.png"></v-img>
                </v-flex>
            </v-layout>


            <v-layout class="my-5 mx-3">
                
                <v-flex column>
                    <v-layout justify-center>
                        <p id="scrollBot" class="title text-xs-center text-sm-center" data-aos="fade-up"
     data-aos-anchor-placement="center-bottom" center >Découvrez nos articles à personaliser - Concevez - Montez - Produisez !</p>
                    </v-layout>
                    <v-container >
                        <v-layout justify-space-around align-center mt-5 wrap >
                            <v-flex xs10 sm10 md3 mb-2 v-for="(category,index) in categories" v-bind:key="index">
                                <v-card class="mx-2" data-aos="fade-up" data-aos-anchor-placement="center-bottom">
                                    <v-parallax
                                    class="white--text"
                                    height="200"
                                    src="https://cdn.vuetifyjs.com/images/cards/docks.jpg"
                                    >
                                    <v-container fill-height fluid>
                                        <v-layout fill-height>
                                        <v-flex xs12 align-end flexbox>
                                            <!-- <span class="headline">{{category.name}}</span> -->
                                        </v-flex>
                                        </v-layout>
                                    </v-container>
                                    </v-parallax>
                                    <v-card-title>
                                    <div>
                                        <span class="grey--text title mb-2">{{category.name}}</span><br>
                                        <span>Whitehaven Beach</span><br>
                                        <span>Whitsunday Island, Whitsunday Islands</span>
                                    </div>
                                    </v-card-title>
                                    <v-card-actions>
                                    <v-btn flat color="teal darken-1"><router-link :to="`/shop#`+category.name" class="teal--text text--darken-2">Découvrir</router-link></v-btn>
                                    </v-card-actions>
                                </v-card>
                            </v-flex>
                        </v-layout>
                    </v-container>
                    <v-container>
                        <p class="hr subheading mt-5"> Voir tous nos produits</p>
                    </v-container>
                    <v-layout justify-center>
                        <router-link to="/shop"><v-btn class="font-weight-bold large" dark color="teal darken-1"> Accédez au shop </v-btn></router-link>
                        
                    </v-layout>
                </v-flex>
            </v-layout>
            <v-layout class="full-height newsletter">
                <v-layout align-center justify-center>
                    <v-flex xs10 sm10 md3 data-aos="zoom-in-up" v-if="isLoggedIn">
                        <p class="title white--text text-xs-center text-sm-center" center >Restez au courant des nouveautés en vous inscrivant à la newsletter !</p>   
                        <!-- <v-text-field dark
                        class=""
                        label="Email" v-validate="'email'" v-model="newsletter_email" name="email"
                        ></v-text-field>
                        <p class="teal--text text--lighten-3 subheading" v-if="errors.has('email')">⚠️ {{ errors.first('email') }}</p> -->
                        <v-layout align-center justify-center>
                            <v-btn dark type="submit" color="teal darken-1"> S'inscrire</v-btn>
                        </v-layout>
                    </v-flex>
                    <v-flex xs10 sm10 md3 data-aos="zoom-in-up" v-if="!isLoggedIn">
                        <p class="title white--text text-xs-center text-sm-center" center >Restez au courant des nouveautés en créant votre compte maintenant !</p>   
                        <!-- <v-text-field dark
                        class=""
                        label="Email" v-validate="'email'" v-model="newsletter_email" name="email"
                        ></v-text-field>
                        <p class="teal--text text--lighten-3 subheading" v-if="errors.has('email')">⚠️ {{ errors.first('email') }}</p> -->
                        <v-layout align-center justify-center>
                            <v-btn dark type="submit" color="teal darken-1" @click="register()">Créer un compte</v-btn>
                        </v-layout>
                    </v-flex>
                </v-layout>
            </v-layout>
            <v-container class="dark">
            
                <v-layout row wrap justify-center>

                    <v-flex xs6 sm3 md3 hidden-xs-only >
                        <v-img src="/img/contact.jpg"></v-img>
                    </v-flex>

                    <v-flex xs12 sm6 md6 class="mt-5">
                        <v-layout justify-center >
                            <v-flex xs12 sm12 md12 ma-2>
                                <h2>Nous contacter</h2>
                                <v-flex column grey darken-3 pa-4 class="mt-5">
                                    <v-text-field dark
                                    class="" v-validate="'required|email'"
                                    label="Email" value="" name="email_contact"
                                    ></v-text-field>
                                     <p class="teal--text text--lighten-3 subheading" v-if="errors.has('email_contact')">⚠️ {{ errors.first('email_contact') }}</p>
                                
                                
                                    <v-textarea dark
                                        name="message_contact" v-validate="'required|min:5|max:255'"
                                        label="Message" ></v-textarea>
                                         <p class="teal--text text--lighten-3 subheading" v-if="errors.has('message_contact')">⚠️ {{ errors.first('message_contact') }}</p>
                                    
                                </v-flex>
                                <v-layout align-center justify-center class="mt-5">
                                    <v-btn dark type="submit" color="teal darken-1"> Envoyer</v-btn>
                                </v-layout>
                            </v-flex>
                        </v-layout>
                    </v-flex>
                </v-layout>
                
            </v-container>


        </v-flex>
    </main>
</template>
<script>
export default {
   
  data(){
            return {
                categories : [],
                newsletter_email : "",
                email_contact : "",
                message_contact : "",
                isLoggedIn : localStorage.getItem('IophotoStore.jwt') != null
            }
        },
        beforeMount() {
           
            if (localStorage.getItem('IophotoStore.jwt') != null) {
                this.user = JSON.parse(localStorage.getItem('IophotoStore.user'))
                axios.defaults.headers.common['Content-Type'] = 'application/json'
                axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('IophotoStore.jwt')
            }

            
            
           
        },
  mounted() {
      axios.get("api/categories/").then(response => this.categories = response.data)
      this.isLoggedIn = localStorage.getItem('IophotoStore.jwt') != null
  },
  methods: {
    
    register() {
        this.$router.push({name: 'register', params: {nextUrl: this.$route.fullPath}})
    },
  },
}
</script>
<style>
    .full-height {
        min-height:100%;
        height: 100vh;
       padding-top:100px;
    }
    .hr {
    display: flex;
    align-items: center;
    margin: 1em 0;
}
.hr::before, .hr::after {
    content: '';
    flex: 1;
    margin: 0 .75em;
    border-bottom: 1px solid #000;
}
.newsletter {
    background: url('/img/bg_newsletter.jpg')
}
a {
    text-decoration:none;
}
</style>
