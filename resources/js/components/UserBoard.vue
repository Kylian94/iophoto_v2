<template>
        <div class="marginNav">
            <div class="container-fluid hero-section d-flex align-content-center justify-content-center flex-wrap ml-auto">
                <h2 class="title text--white text-md-center text-xs-center">Your account</h2>
            </div>
            <div class="container">
                <v-expansion-panel>
                    <v-expansion-panel-content>
                    <template v-slot:header>
                        <div>Adresses</div>
                    </template>
                    <v-card>
                            <v-layout >
                                <v-btn raised hover class="teal darken-2 white--text mx-3" @click="newAddress">New adress</v-btn>
                            </v-layout>
                            
                                <v-radio-group v-model="adress" class="ma-0">
                                    <v-layout>
                                        <v-card class="mr-3 product-box ma-3">
                                            <v-radio value="adress-1"></v-radio><br>
                                            <v-flex column>
                                                <h5><span class="adressName">Maison</span></h5>
                                                <p class="text-muted street ma-0" >192 rue diderot</p>
                                                <p class="text-muted zipCode ma-0">94500</p>
                                                <p class="text-muted city ma-0">Champigny sur Marne</p>
                                                <p class="text-muted country ma-0">FRANCE</p>
                                            </v-flex>
                                        </v-card>
                                        <v-card class="mr-3 product-box ma-3">
                                            <v-radio value="adress-2"></v-radio><br>
                                            <v-flex column>
                                            <h5><span class="adressName">Maison 2</span></h5>
                                                <p class="text-muted street ma-0" >190 rue de verdun</p>
                                                <p class="text-muted zipCode ma-0">94500</p>
                                                <p class="text-muted city ma-0">Champigny sur Marne</p>
                                                <p class="text-muted country ma-0">FRANCE</p>
                                            </v-flex>
                                        </v-card>
                                    </v-layout>
                                </v-radio-group>
                            
                    </v-card>
                    </v-expansion-panel-content>
                </v-expansion-panel>
                <modal @close="endEditing" :user="editingAddress" v-show="editingAddress != null"></modal>
                <modal @close="addAddress"  :user="addingAddress" v-show="addingAddress != null"></modal>
                <v-expansion-panel>
                    <v-expansion-panel-content>
                    <template v-slot:header>
                        <div>Orders</div>
                    </template>
                    <v-card>
                            <v-layout>
                                <v-card class="mr-3 product-box ma-3" v-for="(order,index) in orders" v-bind:key="index">
                                    <v-img :src="order.image" height="300px" :alt="order.product.name"></v-img>
                                    <h5><span v-html="order.product.name"></span><br>
                                        <span class="small-text text-muted">{{order.product.price}} €</span>
                                    </h5>
                                    <hr>
                                    <span class="small-text text-muted">Quantity: {{order.quantity}}
                                        <span class="float-right">{{order.is_delivered == 1? "shipped!" : "not shipped"}}</span>
                                    </span>
                                    <br><br>
                                    <p><strong>Delivery address:</strong> <br>{{order.address}}</p>
                                </v-card>
                            </v-layout>
                    </v-card>
                    </v-expansion-panel-content>
                </v-expansion-panel>
            </div>
        </div>
    </template>

    <style scoped>
    .small-text { font-size: 14px; }
    .product-box { border: 1px solid #cccccc; padding: 10px 15px; width:300px;}
    .hero-section { background: #ababab; height: 20vh; align-items: center; margin-bottom: 20px; margin-top: -20px; }
    .title { font-size: 60px; }
    </style>

    <script>
    import Modal from './AddressModal'
    export default {
        data() {
            return {
                user : null,
                orders : [], 
                adress: '',
                editingAddress: null,
                addingAddress: null,
            }
        },
        components: {Modal},
        beforeMount() {
            this.user = JSON.parse(localStorage.getItem('IophotoStore.user'))

            axios.defaults.headers.common['Content-Type'] = 'application/json'
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('IophotoStore.jwt')

            
        },
        methods: {
            newAddress() {
                this.addingAddress = {
                    name: null,
                    email: null,
                    password: null,
                    is_admin: null,
                }
            }, 

            endEditing(user) {
                this.editingAddress = null

                let index = this.users.indexOf(user)
                let name = user.name
                let email = user.email
                let password = user.password
                let is_admin = user.is_admin
            
                // axios.patch(`/api/users/${user.id}`, {name, email, password, is_admin})
                //      .then(response => this.users[index] = user)
            },
            addAddress(user) {
                this.addingUser = null

                let name = user.name
                let email = user.email
                let password = user.password
                let is_admin = user.is_admin
                

            
                // axios.post("/api/users/", {name, email, password, is_admin})
                //      .then(response => this.users.push(user))
                //      .then(toast.fire({ type: 'success', title: 'User has been created'}))
                     
            },
        },
    }
    </script>