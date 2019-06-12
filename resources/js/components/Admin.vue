<template>
        <div class="marginNav">

            <div class="container-fluid hero-section d-flex align-content-center justify-content-center flex-wrap ml-auto">
                <h2 class="title text-md-center text-xs-center">Admin Dashboard</h2>
            </div>
            
            <v-layout>
                
                <v-navigation-drawer permanent>
                    <v-layout class="align-center justify-center">
                        <v-flex>
                            <v-toolbar flat class="teal lighten-3">
                            <v-list>
                                <v-list-tile @click="setComponent('main')">
                                    
                                            <v-list-tile-title class="title">
                                                Dashboard
                                            </v-list-tile-title>
                                        
                                </v-list-tile>
                            </v-list>
                            </v-toolbar>
                        </v-flex>
                    </v-layout>
                    <v-divider></v-divider>

                    
                    <v-list dense class="pt-0">
                    <v-list-tile  @click="setComponent('products')">
                        <v-list-tile-action>
                        📦
                        </v-list-tile-action>
                        <v-list-tile-content>
                        <v-list-tile-title>Products</v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                    </v-list>

                    <v-list dense class="pt-0">
                    <v-list-tile @click="setComponent('categories')">
                        <v-list-tile-action>
                        📂
                        </v-list-tile-action>
                        <v-list-tile-content>
                        <v-list-tile-title>Categories</v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                    </v-list>

                    <v-list dense class="pt-0">
                    <v-list-tile @click="setComponent('users')">
                        <v-list-tile-action>
                        🐵
                        </v-list-tile-action>
                        <v-list-tile-content>
                        <v-list-tile-title>Users</v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                    </v-list>

                    <v-list dense class="pt-0">
                    <v-list-tile @click="setComponent('orders')">
                        <v-list-tile-action>
                        🚚
                        </v-list-tile-action>
                        <v-list-tile-content>
                        <v-list-tile-title>Orders</v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                    </v-list>


                </v-navigation-drawer>
                    <!-- <ul style="list-style-type:none">
                        <li class="active"><button class="btn" @click="setComponent('main')">Dashboard</button></li>
                        <li><button class="btn" @click="setComponent('orders')">Orders</button></li>
                        <li><button class="btn" @click="setComponent('products')">Products</button></li>
                        <li><button class="btn" @click="setComponent('users')">Users</button></li>
                    </ul> -->
                
                <v-flex>
                    <component :is="activeComponent"></component>
                </v-flex>
            </v-layout>
            
        </div>
    </template>

    <script>
    import Main from '../components/admin/Main'
    import Users from '../components/admin/Users'
    import Products from '../components/admin/Products'
    import Orders from '../components/admin/Orders'
    import Categories from '../components/admin/Categories'

    export default {
        data() {
            return {
                user: null,
                activeComponent: null
            }
        },
        components: {
            Main, Users, Products, Orders, Categories
        },
        beforeMount() {
            this.setComponent(this.$route.params.page)
            this.user = JSON.parse(localStorage.getItem('IophotoStore.  d fuser'))
            axios.defaults.headers.common['Content-Type'] = 'application/json'
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('IophotoStore.jwt')
        },
        methods: {
            setComponent(value) {
                switch(value) {
                    case "users":
                        this.activeComponent = Users
                        this.$router.push({name: 'admin-pages', params: {page: 'users'}})
                        break;
                    case "orders":
                        this.activeComponent = Orders
                        this.$router.push({name: 'admin-pages', params: {page: 'orders'}})
                        break;
                    case "products":
                        this.activeComponent = Products
                        this.$router.push({name: 'admin-pages', params: {page: 'products'}})
                        break;
                    case "categories":
                        this.activeComponent = Categories
                        this.$router.push({name: 'admin-pages', params: {page: 'categories'}})
                        break;
                    default:
                        this.activeComponent = Main
                        this.$router.push({name: 'admin'})
                        break;
                }
            }
        }
    }
    </script>

    <style scoped>
    .hero-section { height: 20vh; background: #ababab; align-items: center; margin-top: -20px; }
    .title { font-size: 60px; color: #ffffff; }
    </style>