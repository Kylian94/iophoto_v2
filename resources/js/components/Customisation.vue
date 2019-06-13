<template>
        <div class="customPage">
            <!-- <div class="row">
                <div class="col-md-8 offset-md-2">
                    <img :src="product.image" :alt="product.name">
                    <h3 class="title" v-html="product.name"></h3>
                    <p class="text-muted">{{product.description}}</p>
                    <h4>
                        <span class="small-text text-muted float-left">$ {{product.price}}</span>
                        <span class="small-text float-right">Available Quantity: {{product.units}}</span>
                    </h4>
                    <br>
                    <hr>
                    <div>
                        <div v-if="!isLoggedIn">
                            <h2>You need to login to continue</h2>
                            <button class="col-md-4 btn btn-primary float-left" @click="login">Login</button>
                            <button class="col-md-4 btn btn-danger float-right" @click="register">Create an account</button>
                        </div>
                        <div v-if="isLoggedIn">
                            <button class="col-md-4 btn btn-sm btn-primary float-left" v-if="isLoggedIn" @click="placeOrder">Save & continue</button>
                            <button class="col-md-4 btn btn-sm btn-success float-right" v-if="isLoggedIn" @click="addToCart">Save & pay</button>
                        </div>
                    </div>
                     <router-link :to="{ path: '/checkout?pid='+product.id }" class="col-md-4 btn btn-sm btn-primary float-right">Save</router-link> 
                </div>
            </div> -->
            
                <v-layout class="paddingNav hidden-sm-and-down" >
                    <v-flex md3 class="gallery " v-bind:class="{ bgDisabled : disabled }">
                        
                    </v-flex>
                    <v-flex md6>
                        <v-layout class=" teal lighten-5 " id="projectName" text-md-center >
                            
                                
                                <v-flex class="">
                                    <v-form>
                                    <v-layout justify-center id="borderRed" class="borderRed">
                                        <v-flex md6  >
                                            <v-text-field v-model="projectName" class="projectName" label="Nom de votre projet" p0 m0 required counter maxlength="56" :rules="rules"></v-text-field>
                                        </v-flex>
                                        <!-- <v-btn type="submit" class="teal darken-1 white--text mt-3" >Save</v-btn> -->
                                    </v-layout>
                                        
                                    </v-form>
                                </v-flex>

                        </v-layout>
                        
                        <v-layout align-center justify-center class="book mt-4">
                            
                            <v-flex md12 text-md-center class="page elevation-4 nb1" >
                                <v-layout  align-center justify-center column fill-height>
                                    <v-container align-center justify-center flex-column fill-height>
                                        <v-flex md12 class="parent">
                                            <img :src="product.image" :alt="product.name" class="image1">
                                            <img src="/img/logo_dark.png" alt="" class="image2">
                                        </v-flex>
                                    </v-container>
                                </v-layout>          
                            </v-flex>
                        </v-layout>
                        <v-layout justify-space-between>
                            <form method="post" class="mt-3" enctype="multipart/form-data">
                                <input :disabled="projectName == defaultName" type="file" id="files" ref="files" multiple="" />
                                <v-btn raised dark type="submit" class="teal darken-2" @click.prevent="uploadFiles()" :disabled="projectName == defaultName">Valider</v-btn>
                            </form>
                            <v-btn raised hover dark color="teal darken-2 mt-3 mx-0 " :disabled="projectName == defaultName">Save</v-btn>
                        </v-layout>
                        
                    </v-flex>
                </v-layout>

                <div id="overlayGallery" class="hidden-sm-and-down" >
                    
                </div>
                <div id="overlayAlbum" class="hidden-sm-and-down">
                    
                </div>
                <div id="overlayBlock" class="hidden-sm-and-down">
                    
                </div>

        </div>
    </template>

    <script>
    export default {
        props : ['pid'],
        scrollBehavior() {
            return { x: 0, y: 0 };
        },
        data(){
            
            return {
                isLoggedIn : null,
                product : [],
                projectName: '',
                defaultName: '',
                disabled: true,
                rules: [v => v.length <= 56 || 'Max 56 characters'],
            }
        },
        watch : {
            projectName() {
                if(this.projectName.length > 0) {
                    this.disabled = false
                    document.getElementById("overlayGallery").style.display = "none";
                    document.getElementById("overlayAlbum").style.display = "none";
                    document.getElementById("overlayBlock").style.display = "none";
                    
                    
                } else {
                    this.disabled = true
                    document.getElementById("overlayGallery").style.display = "block";
                    document.getElementById("overlayAlbum").style.display = "block";
                    document.getElementById("overlayBlock").style.display = "block"; 
                    
                    
                }
                
            }
        },
        mounted() {
            this.isLoggedIn = localStorage.getItem('IophotoStore.jwt') != null
            
        },
        beforeMount(){
            swal.fire({
                        title: "Give it a name !",
                        text: "Please enter a name to your creation",
                        type: "warning",
                    })
            axios.get(`/api/products/${this.pid}`).then(response => this.product = response.data)

            if (localStorage.getItem('IophotoStore.jwt') != null) {
                this.user = JSON.parse(localStorage.getItem('IophotoStore.user'))
                axios.defaults.headers.common['Content-Type'] = 'application/json'
                axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('IophotoStore.jwt')
            }     
        },
        methods: {
            addToCart() {

            },
            login() {
                this.$router.push({name: 'login', params: {nextUrl: this.$route.fullPath}})
            },
            register() {
                this.$router.push({name: 'register', params: {nextUrl: this.$route.fullPath}})
            },
            placeOrder(e) {
                e.preventDefault()

                let address = this.address
                let product_id = this.product.id
                let quantity = this.quantity

                axios.post('api/orders/', {address, quantity, product_id})
                     .then(response => this.$router.push('/confirmation'))
            },
        },
    }
    </script>

    <style scoped>
    
    .parent {
    position: relative;
    top: 0;
    left: 0;
    }
    .image1 {
    position: relative;
    top: 0;
    left: 0;
    height:380px;
    width:380px;
    }
    .image2 {
    position: absolute;
    top: 150px;
    left: 140px;
    height:100px;
    width:100px;
    }
    .paddingNav {
        padding-top:90px;
        height:100vh;

        
    }
    .page {
       height:500px;
       
   }
    .small-text { font-size: 18px; }
    .title { font-size: 36px; }
    #overlayGallery {
  position: fixed;
  display: block;
  width: 475px;
  height: 100%;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: rgba(0,0,0,0.5);
  z-index: 2;
  cursor:  not-allowed;
}
#overlayAlbum {
  position: fixed;
  display: block;
  width: 950px;
  height: 100%;
  top: 180px;
  left: 475px;
  right: 0;
  bottom: 0;
  background-color: rgba(0,0,0,0.5);
  z-index: 2;
  cursor:  not-allowed;
}
#overlayBlock {
  position: fixed;
  display: block;
  width: 475px;
  height: 100%;
  top: 0;
  left: 1425px;
  right: 0;
  bottom: 0;
  background-color: rgba(0,0,0,0.5);
  z-index: 2;
  cursor:  not-allowed;
}
    </style>