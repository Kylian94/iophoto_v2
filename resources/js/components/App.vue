<template>
    <div>
        <nav class="navbar homeNav navbar-expand-md navbar-dark navbar-laravel grey darken-4 fixed-top">
            
                <img class="mr-2" src="/img/logo_white.png" alt="logo IOPhoto">
                <router-link :to="{name: 'home'}" class="navbar-brand title">IO.Photo</router-link>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto"></ul>
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <router-link :to="{ name: 'shop' }" class="nav-link white--text">🎁 Boutique</router-link>
                        <router-link :to="{ name: 'about' }" class="nav-link white--text">📰 A propos</router-link>
                        <button data-toggle="modal" data-target="#cart" class="nav-link white--text">🛒 Shopping Cart ({{badges}})</button>
                        <router-link :to="{ name: 'login' }" class="nav-link white--text" v-if="!isLoggedIn">🔒 Connexion</router-link>
                        <router-link :to="{ name: 'register' }" class="nav-link white--text" v-if="!isLoggedIn"></router-link>
                        <span v-if="isLoggedIn">
                            <router-link :to="{ name: 'userboard' }" class="nav-link white--text" v-if="user_type == 0">🤷‍♂ Hi, {{name}}</router-link>
                            <router-link :to="{ name: 'admin' }" class="nav-link white--text" v-if="user_type == 1">🧙‍ Hi, {{name}}</router-link>
                        </span>
                        <li class="nav-link white--text" v-if="isLoggedIn" @click="logout">⛔️ Logout</li>
                    </ul>
                </div>
            
        </nav>
        <main class="">
            <div class="modal fade" id="cart">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Your Shopping Cart</h5>
                            <button class="close" data-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <table class="table table-striped text-left">
                                <tbody>
                                    <tr v-for="(cart, n) in carts" v-bind:key="cart.id" :index="n">
                                        <td><img class="img_cart" :src="cart.image" alt="image_product"></td>
                                        <td>{{cart.name}}</td>
                                        <td>{{cart.price}} €</td>
                                        <td><input type="text" readonly class="form-control" v-model="cart.quantity"></td>
                                        <td><button @click="removeCart(n)" class="btn btn-danger white--text">X</button></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            Total Price : {{totalprice}} € <br>
                            <router-link :to="'/checkout'" data-dismiss="modal"> <v-btn raised hover class="teal dark-darken-3 white--text">Valider le panier</v-btn> </router-link>
                        </div>
                    </div>
                </div>
            </div>
            <router-view @loggedIn="change"></router-view>
        </main>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                name: null,
                user_type: 0,
                isLoggedIn: localStorage.getItem('IophotoStore.jwt') != null,
                carts: JSON.parse(localStorage.getItem('IophotoStore.carts')),
                badges : JSON.parse(localStorage.getItem('IophotoStore.carts')).length,
                
            }
        },
        mounted() {
            this.setDefaults()
            
            // let carts = JSON.parse(localStorage.getItem('IophotoStore.carts'))
            // if (carts) {
            //     this.carts = carts
            // } else {
            //     this.carts = []
            // }
            
            // let badges = JSON.parse(localStorage.getItem('IophotoStore.carts')).length
            // if (badges) {
            //     this.badges = badges
            // } else {
            //     this.badges = '0'
            // }

            
        },
        computed: {
            totalprice() {
                 let totalprice = 0;
                 if(localStorage.getItem('IophotoStore.carts') != null) {
                    this.carts.forEach(e => {
                        totalprice += e.price;
                    });
                    return totalprice
                 }
            },
             
        },
        watch: {
            // badges() {
            //      let badges = 0;
            //      if(localStorage.getItem('IophotoStore.carts') != null) {
            //          badges = this.localStorage.getItem('IophotoStore.carts').length
            //      }
            //      return badges
            //  }
        },
        methods : {
            setDefaults() {
                if (this.isLoggedIn) {
                    let user = JSON.parse(localStorage.getItem('IophotoStore.user'))
                    let carts = JSON.parse(localStorage.getItem('IophotoStore.carts'))
                    let badges = 0
                    this.name = user.name
                    this.user_type = user.is_admin
                }
            },
            closeModal() {
                document.querySelector('#cart').modal('hide')
                
            },
            viewCart() {
                if(localStorage.getItem('IophotoStore.carts') != null) {
                    this.carts = JSON.parse(localStorage.getItem('IophotoStore.carts'));
                    this.badges = this.carts.length;
                    
                }
            },
            removeCart(product) {
                this.carts.splice(product, 1)
                this.storeCart()
            },
            storeCart(){
                let parsed = JSON.stringify(this.carts);
                localStorage.setItem('IophotoStore.carts', parsed);
                this.viewCart();
                
            },
            change() {
                this.isLoggedIn = localStorage.getItem('IophotoStore.jwt') != null
                this.setDefaults()
            },
            logout(){
                localStorage.removeItem('IophotoStore.jwt')
                localStorage.removeItem('IophotoStore.user')
                localStorage.removeItem('IophotoStore.carts')
                localStorage.removeItem('carts')
                this.change()
                window.location.assign("/")
            }
        }
    }
</script>
<style>
.homeNav {
    min-height:110px;
    max-height:110px;
}
.nav-link {
    cursor:pointer;
}
.img_cart {
    width:100px;
    height:100px;
}
</style>
