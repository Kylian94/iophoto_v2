<template>
    <div class="marginNav">
        <!-- HEADER -->
        <v-layout class="container-fluid hero-section d-flex align-content-center justify-content-center flex-wrap ml-auto">
            <h2 class=" title text-md-center text-xs-center">Welcome to the IOPhoto Store</h2>
        </v-layout>
        <!-- NAVBAR CATEGORIES -->
        <v-layout dark black align-center justify-center class="white--text nav_shop header" id="myHeader" py-3>
            <a v-for="(category,index) in categories" v-bind:key="index" class="navCatLink white--text mx-4" :href="'#'+category.name" v-smooth-scroll="{ duration: 1000, offset: -180}">
            {{category.name}}
            </a> 
        </v-layout>
        <!-- CATEGORIES PARTS WITH ARTICLES -->
        <v-layout v-for="(category,index) in categories" v-bind:key="index" class="">
            <v-flex :id="category.name" class="categoryPart align-center pt-md-4">
                <v-layout justify-content-center>
                    <h1 class="text-xs-center text-md-center title text--black hr">{{category.name}}</h1>
                </v-layout>
                <div  class="container content" id="example-content">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="row">
                                <!-- ARTICLE BY CATEGORY -->
                                <v-card  hover class="rounded-card mx-3" style="min-width:200; max-width:300px" v-for="(product,index) in products" v-bind:key="index" >
                                    <v-layout v-if="product.category_id == category.id" v-show="product.category_id == category.id">
                                        <router-link :to="{ path: '/products/'+product.id}" >
                                            <v-img
                                            class="rounded-img"
                                            height="300px"
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
                                    </v-layout>
                                </v-card>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </v-flex> 
        </v-layout>
        
    </div>
</template>

<script>
    export default {
        data(){
            return {
                products : [],
                categories : []
            }
        },
        mounted(){
            axios.get("api/products/").then(response => this.products = response.data)
            axios.get("api/categories/").then(response => this.categories = response.data)

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
.navCatLink { transition: all .3s ease-in-out;
margin-left:5px;
margin-right:5px; }
.navCatLink:hover { transform: scale(1.3); }

/* Style the header */
.categoryPart {
    min-height:80vh;
}
.header {
  padding:30px;
  background: #555;
  color: #f1f1f1;
}

/* Page content */
.content {
  
  z-index:1;
}
.product-card-description {
    width:300px;
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

.images_shop {
    max-width:200px;
    max-height:200px;
}
.marginNav {
    margin-top:100px;
}
.hr {
    display: flex;
    align-items: center;
    margin: 1em 0;
    width:340px;
}
 .hr::after {
    content: '';
    flex: 1;
    margin: 0 .75em;
    border-bottom: 1px solid #000;
}
</style>