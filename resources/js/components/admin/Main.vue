<template>
        <v-layout ml-4 mt-2>
                <v-layout class="md-3 product-box align-center justify-items-center big-text adminCTA navCatLink">
                    <v-flex class="text-md-center text-xs-center">
                        <a class="white--text" href='/admin/orders'>Orders ({{orders.length}})</a>
                    </v-flex>
                </v-layout>
                <v-layout class="md-3 product-box align-center justify-items-center big-text adminCTA  navCatLink">
                    <v-flex class="text-md-center text-xs-center">
                        <a class="white--text" href='/admin/products'>Products ({{products.length}})</a>
                    </v-flex>
                </v-layout>
                <v-layout class="md-3 product-box align-center justify-items-center big-text adminCTA  navCatLink">
                    <v-flex class="text-md-center text-xs-center">
                    <a class="white--text" href='/admin/users'>Users ({{users.length}})</a>
                    </v-flex>
                </v-layout>
                <hr>
        </v-layout>
    </template>

    <script>
    export default {
        data() {
            return {
                user : null,
                orders : [],
                products : [],
                users : []
            }
        },
        mounted() {
            axios.get('/api/users/').then(response => this.users = response.data)
            axios.get('/api/products/').then(response => this.products = response.data)
            axios.get('/api/orders/').then(response => this.orders = response.data)
        }
    }
    </script>

    <style scoped>
    a {
        text-decoration:none;
    }

    .big-text { font-size: 28px; }
    .product-box { border: 1px solid #cccccc; padding: 15px 15px; height: 20vh; margin:10px; }
    .navCatLink { transition: all .3s ease-in-out;
    background-color:#B0BEC5;}
    .navCatLink:hover { transform: scale(1.1); 
                        background-color:#26A69A;
                        }
    </style>