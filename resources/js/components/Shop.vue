<template>
    <div class="marginNav">
        <v-layout class="container-fluid hero-section d-flex align-content-center justify-content-center flex-wrap ml-auto">
            <h2 class=" title text-md-center text-xs-center">Welcome to the IOPhoto Store</h2>
        </v-layout>

         <v-layout dark black align-center justify-center class="white--text nav_shop header" id="myHeader" py-3>
            <a class="mr-2 white--text" href="#stickers" v-smooth-scroll="{ duration: 1000, offset: -180}">Stickers</a> |
            <a class="mx-2 white--text" href="#materiel" v-smooth-scroll="{ duration: 1000, offset: -130}">Materiel</a> |
            <a class="ml-2 white--text" href="#album" v-smooth-scroll="{ duration: 1000, offset: -130}">Album Photo</a>
        </v-layout> 
        
        
        <div class="container content" id="example-content">
            <div class="row">
                <div class="col-md-8">
                    <div class="row">
                        <v-card hover class="my-2 mx-3 rounded-card" style="min-width:200; max-width:300px" v-for="(product,index) in products" v-bind:key="index">
                            <router-link :to="{ path: '/products/'+product.id}">
                                <v-img
                                class="rounded-img"
                                height="400px"
                                :src="product.image">
                            
                                </v-img>
                                
                                <v-card-text class="pb-0 fade-out product-card-description">
                                    <span class="headline shadow-text grey--text text--darken-4">
                                    {{ product.name }}
                                    </span><br>

                                    {{product.description}}
                                </v-card-text>
                                <v-card-text class="pb-0 center-text small-text text-muted">
                                    {{ product.price}} € &nbsp; - &nbsp;
                                    Stock: {{product.units}}
                                </v-card-text>
                                <v-card-actions class="justify-start">
                                    <v-btn primary
                                        v-if="product.units > 0"
                                        @click.native="addToCart(product)"
                                    >
                                        Acheter
                                    </v-btn>
                                    <v-btn disabled
                                        v-if="product.units <= 0">
                                        Produit épuisé
                                    </v-btn>
                                </v-card-actions>
                            </router-link>
                        </v-card>
                    </div>
                </div>
                <div class="col-md-4 teal darken-2 cart">
                    <h1 class="title white--text">Shopping Cart</h1>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                products : []
            }
        },
        mounted(){
            axios.get("api/products/").then(response => this.products = response.data)

            // STICKY NAV PRODUCTS

            window.onscroll = function() {
                stickMenu()
            };
            // Get the header
            var header = document.getElementById("myHeader");
            // Get the offset position of the navbar
            var sticky = header.offsetTop;
            // Add the sticky class to the header when you reach its scroll position. Remove "sticky" when you leave the scroll position
            function stickMenu() {
            if (window.pageYOffset > sticky+10) {
            header.classList.add("sticky");
            } else {
            header.classList.remove("sticky");
            }
            }
 
        }
    }
</script>

<style scoped>

a {  text-decoration: none;}
/* Style the header */
.header {
  padding:30px;
  background: #555;
  color: #f1f1f1;
}

/* Page content */
.content {
  
  z-index:1;
}

/* The sticky class is added to the header with JS when it reaches its scroll position */
.sticky {
  position: fixed;
  top: 110px;
  width: 100%;
  z-index:2;
}

/* Add some top padding to the page content to prevent sudden quick movement (as the header gets a new position at the top of the page (position:fixed and top:0) */
.sticky + .content {
  padding-top: 80px;
}

.cart {
    height: 400px;
}
.rounded-card {
    border-radius:5px;
}
.rounded-img {
    border-top-left-radius:5px;
    border-top-right-radius:5px;
}
.small-text {
    font-size: 14px;
}
.product-box {
    /* border: 1px solid #cccccc; */
    padding: 10px 15px;
}
.hero-section {
    height: 30vh;
    background-image: linear-gradient(-20deg, #00cdac 0%, #8ddad5 100%);
    align-items: center;
    margin-top: -20px;
}
.title {
    font-size: 60px;
    color: #ffffff;
}
.images_shop {
    max-width:200px;
    max-height:200px;
}
.marginNav {
    margin-top:100px;
}
</style>