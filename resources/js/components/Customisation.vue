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
            
                <v-layout class="paddingNav fullHeight hidden-sm-and-down" >
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
                                    <v-container align-center justify-center flex-column fill-height >
                                        <v-flex md12 class="parent" ref="printMe">
                                            <img :src="product.image" :alt="product.name" class="image1" >
                                            <img v-if="url" :src="url" class="image2">
                                        </v-flex>
                                    </v-container>
                                </v-layout>          
                            </v-flex>
                        </v-layout>
                        <v-layout justify-space-between>
                            <form method="post" class="mt-3" enctype="multipart/form-data">
                                <input :disabled="projectName == defaultName" type="file" id="files" @change="onFileChange" ref="files" multiple="" />
                                <v-btn raised dark class="red lighten-1" @click.prevent="deleteFile()" v-if="url">X</v-btn>
                                <v-btn raised dark type="submit" class="teal lighten-1" @click.prevent="screenShot()" :disabled="projectName == defaultName">Upload Image</v-btn>
                            </form>
                            
                                <div class="float-right" v-show="url">
                                    <v-btn raised hover dark color="teal lighten-2 mt-3 mx-0 " :disabled="projectName == defaultName" @click="addCart()">Continuer</v-btn>
                                    <v-btn raised hover dark color="teal darken-2 mt-3 mx-0 " :disabled="projectName == defaultName" @click="placeOrder()">Acheter</v-btn>
                                </div>
                            
                        </v-layout>
                        <!-- OUTPUT -->
                        <img :src="output" alt="" srcset="" hidden>
                        
                    </v-flex>
                </v-layout>

                <div id="overlayGallery" class="hidden-sm-and-down" >
                    
                </div>
                <div id="overlayAlbum" class="hidden-sm-and-down">
                    
                </div>
                <div id="overlayBlock" class="hidden-sm-and-down">
                    
                </div>
                <v-layout flex-column class="paddingNav hidden-md-and-up" >
                    <h1 class="pa-3 mx-auto">🚨 Informations 🚨</h1>
                    <img class="gif mx-auto mb-3" src="https://media.giphy.com/media/fny1GW0e4GGGcgcUVU/giphy.gif" alt="gif_sorry">
                    <v-flex class="grey lighten-3 pa-3">
                        <h2>Malheureusment...</h2>
                        <p class="subHeading">Le module de personnalisation n'est pas encore disponible sur mobile.</p>
                    </v-flex>
                    <v-flex class="pa-3">
                        <h2>📣 On vous tiens au courant..</h2>
                        <p>Pour recevoir des informations sur la sortie du module personnalisation sur mobile, renseignez votre adresse mail ci-dessous 🔻</p>
                        <v-text-field v-model="askMobileModule" label="Email"></v-text-field>
                        <v-layout justify-end>
                            <v-btn dark raised class="teal darken-2">Avoir l'info</v-btn>
                        </v-layout>
                    </v-flex>
                </v-layout>

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
                imgProduct: '',
                defaultName: '',
                disabled: true,
                rules: [v => v.length <= 56 || 'Max 56 characters'],
                url: null,
                askMobileModule: '',
                output: null,
                image: '',
                order: [],
                adress: '',
                quantity : 1,
                addingOrder: null,
                carts: [],
                cartadd: {
                    id: '',
                    name: '',
                    price : '',
                    quantity: '',
                    image: '',
                },
                
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
            console.log(screen.width)
            if(screen.width > 380) {
                swal.fire({
                        title: "Give it a name !",
                        text: "Please enter a name to your creation",
                        type: "warning",
                    })
            } 

            axios.get(`/api/products/${this.pid}`).then(response => this.product = response.data)

            if (localStorage.getItem('IophotoStore.jwt') != null) {
                this.user = JSON.parse(localStorage.getItem('IophotoStore.user'))
                axios.defaults.headers.common['Content-Type'] = 'application/json'
                axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('IophotoStore.jwt')
            }  
        },
        created() {
            this.viewCart();
        },
        methods: {
            
            login() {
                this.$router.push({name: 'login', params: {nextUrl: this.$route.fullPath}})
            },
            register() {
                this.$router.push({name: 'register', params: {nextUrl: this.$route.fullPath}})
            },
            viewCart() {
                if(localStorage.getItem('IophotoStore.carts')) {
                    this.carts = JSON.parse(localStorage.getItem('IophotoStore.carts'));
                    //this.badges = this.carts.length;  
                }
            },
            addCart() {
                //console.log(this.product.id)
                this.cartadd.id = this.product.id
                this.cartadd.name = this.product.name
                this.cartadd.price = this.product.price
                this.cartadd.quantity = this.quantity
                this.cartadd.image = this.image
                this.carts.push(this.cartadd);
                //localStorage.setItem('IophotoStore.carts', JSON.stringify(this.carts))
                this.cartadd = {}
                this.storeCart()
            },
            removeCart(product) {
                this.carts.splice(product, 1)
                this.storeCart()
            },
             storeCart(){
                 let parsed = JSON.stringify(this.carts);
                 localStorage.setItem('IophotoStore.carts', parsed);
                 this.viewCart()
                 
                 window.location.assign("/shop")
                 //this.$router.push("/shop")
             },
            placeOrder() {
                //console.log(this.image)
                let address = this.address
                let product_id = this.product.id
                let quantity = this.quantity
                let image = this.image

                axios.post('api/orders/', {image, product_id, quantity, address})
                     .then(response => this.$router.push('/confirmation'))
            },
            onFileChange(e) {
                const file = e.target.files[0];
                const fileName = file.name;
                this.imgProduct = fileName;
                this.url = URL.createObjectURL(file);
            },
            deleteFile() {
                this.url = '';
            },
            async screenShot() {

                const el = this.$refs.printMe
                const options = {
                    type: 'dataURL'
                }
                this.output = await this.$html2canvas(el, options)
            
                if(this.url == null) {
                    swal.fire({
                    title: "Image required",
                    text: "You may forget an image..",
                    type: "warning",
                }).then(function () {

                }.bind(this)).catch(errors => {});
                } else {
                 
                    swal.fire({
                        title: "Image upload",
                        text: "Your image uploaded succefully",
                        type: "success",
                    }).then(function () {
                        this.uploadFile()
                    }.bind(this)).catch(errors => {});
                }

                

                
                 
                 
            },
            uploadFile(event) {
                var that = this;
                if (this.output != null) {

                    var formData = new FormData();
                    formData.append("image", this.output)
                    let headers = {'Content-Type': 'multipart/form-data'}
                    axios.post("/api/upload-file-order", formData, {headers}).then(response => {
                        that.image = response.data
                        that.image = this.image
                    })
                } 
            },
        },
    }
    </script>

    <style scoped>
    .gif {
        height:300px;
        width:300px;
    }
    .v-btn {
      margin: 0;  
    }
    .parent {
    position: relative;
    top: 0;
    left: 0;
    }
    .image1 {
    position: relative;
    top: 0;
    left: 0;
    height:370px;
    width:370px;
    }
    .image2 {
    position: absolute;
    top: 140px;
    left: 120px;
    height:125px;
    width:125px;
    }
    .paddingNav {
        padding-top:90px;
          
    }
    .fullHeight {
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