<template>
        <div class="container marginNav">
            <div class="row">
                <v-layout>
                    <v-flex class="md8">
                        <div class="card">
                            <h3 class="card-header">Order summary</h3>
                            <div class="card-body">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(cart, n) in carts" v-bind:key="cart.id" :index="n">
                                            <td>
                                                 <v-layout flex-column>
                                                    <v-flex>{{cart.name}}</v-flex>
                                                    <v-flex><img class="img_cart" :src="cart.image" alt="image_product"></v-flex>
                                                </v-layout>
                                            </td>
                                            <td>{{cart.price}} €</td>
                                            <td>{{cart.quantity}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="mt-2 text-right">
                                    <p>Total : {{ total }} €</p>
                                    <div v-if="!isLoggedIn">
                                        <h4>Vous devez être connecter pour continuer</h4>
                                        <router-link :to="'/login'">
                                            <v-btn raised hover class="teal teal-darken-2 white--text">
                                                Se connecter
                                            </v-btn>
                                        </router-link>
                                        <router-link :to="'/register'">
                                            <v-btn raised hover class="teal teal-lighten-1 white--text">
                                                Créer un compte
                                            </v-btn>
                                        </router-link>
                                    </div>
                                    <div v-if="isLoggedIn">
                                        <v-btn raised hover class="teal teal-lighten-3 white--text">Payer avec Stripe</v-btn>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        
                            <!-- <tbody>
                                <tr v-for="(cart, n) in carts" v-bind:key="cart.id" :index="n">
                                    <td><img class="img_cart" :src="cart.image" alt="image_product"></td>
                                    <td>{{cart.name}}</td>
                                    <td>{{cart.price}} €</td>
                                    <td><input type="text" readonly class="form-control" v-model="cart.quantity"></td>
                                    <td><button @click="removeCart(n)" class="btn btn-danger white--text">X</button></td>
                                </tr>
                            </tbody>
                        </table> -->
                    </v-flex>
                </v-layout>
            </div>
        </div>
    </template>

    <style scoped>
    .small-text { font-size: 18px; }
    .order-box { border: 1px solid #cccccc; padding: 10px 15px; }
    .title { font-size: 36px; }
    </style>

    <script>
    export default {
        props : ['pid'],
        data(){
            return {
                carts: JSON.parse(localStorage.getItem('IophotoStore.carts')),
                total: '0',
                isLoggedIn : localStorage.getItem('IophotoStore.jwt') != null
                
            }
        },
        mounted() {
            this.isLoggedIn = localStorage.getItem('IophotoStore.jwt') != null
            
            
        },
        created() {
            this.viewcart()
        },
        computed: {
             
        },
        beforeMount() {
           
            if (localStorage.getItem('IophotoStore.jwt') != null) {
                this.user = JSON.parse(localStorage.getItem('IophotoStore.user'))
                axios.defaults.headers.common['Content-Type'] = 'application/json'
                axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('IophotoStore.jwt')
            }

            
            
           
        },
        methods : {

            viewcart() {
                if(localStorage.getItem('IophotoStore.carts')) {
                    this.carts = JSON.parse(localStorage.getItem('IophotoStore.carts'));
                    this.total = this.carts.reduce((total, item) => {
                        return total + item.quantity * item.price;
                    }, 0)
                    
                }
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
            checkUnits(e){
                if (this.quantity > this.product.units) {
                    this.quantity = this.product.units
                }
            }
        }
    }
    </script>