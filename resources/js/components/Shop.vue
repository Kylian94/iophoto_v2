<template>
    <div class="marginNav">
        <!-- HEADER -->
        <v-layout class="container-fluid hero-section d-flex align-content-center justify-content-center flex-wrap ml-auto">
            <h2 class=" title text-md-center text-xs-center"></h2>
        </v-layout>
        <!-- NAVBAR CATEGORIES -->
        <v-layout dark black align-center justify-center class="white--text nav_shop header" id="myHeader" py-3>
            <a v-for="(category,index) in categories" v-bind:key="index" class="navCatLink white--text mx-4" :href="'#'+category.name" v-smooth-scroll="{ duration: 1000, offset: -180}">
            {{category.name}}
            </a> 
        </v-layout>
        <!-- CATEGORIES PARTS WITH ARTICLES -->
        <v-layout v-for="(category,index) in categories" v-bind:key="index" >
            <v-flex :id="category.name" class="categoryPart align-center pt-md-4">
                <v-layout justify-content-center>
                    <h1 class="text-xs-center text-md-center title text--black hr">{{category.name}}</h1>
                </v-layout>
                <div  class="container content" id="example-content">
                    <div class="row justify-xs-center">
                        <v-flex v-for="(product, index) in products" v-bind:key="index" v-show="product.category_id == category.id" xs10 sm10 md4>
                            <v-badge raised color="grey lighten-3" overlap>
                                <template v-slot:badge>
                                    <span v-if="product.units > 0">✅</span>
                                    <span v-if="product.units <= 0">❌</span> 
                                </template>
                                
                                    <v-card color="" class=" card_product mx-4 mb-4" hover>
                                    <v-layout>
                                        <v-flex xs5 ma-auto>
                                        <v-img
                                            :src="product.image"
                                            height="125px"
                                            contain
                                        ></v-img>
                                        </v-flex>
                                        <v-flex xs7>
                                        <v-card-title primary-title >
                                            <div>
                                            <div class="headline">{{ product.name }}</div>
                                            <div class=""> {{product.description | truncate(55)}}</div>
                                            </div>
                                        </v-card-title>
                                        </v-flex>
                                    </v-layout>
                                    <v-divider light></v-divider>
                                    <v-card-actions class="pa-3" >
                                        <span class="subheading teal--text text--darken-2"><b>{{ product.price}} €</b> </span>
                                        <v-spacer></v-spacer>
                                        <router-link :to="{ path: '/products/'+product.id}" >
                                            <v-btn dark  color="teal lighten-3 mr-2"
                                                    >
                                            <!-- @click.native="addToCart(product)" -->
                                                En savoir +
                                            </v-btn>
                                        </router-link>
                                        <router-link :to="{ path: '/customisation?pid='+product.id}" >
                                            <v-btn dark  color="teal darken-1"
                                                    v-if="product.units > 0">
                                            <!-- @click.native="addToCart(product)" -->
                                                Choisir
                                            </v-btn>
                                        </router-link>
                                        <v-btn dark raised color="teal darken-1"
                                            v-if="product.units <= 0">
                                            Épuisé
                                        </v-btn>
                                    </v-card-actions>
                                    </v-card>
                                
                            </v-badge>
                        </v-flex>      
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
            if (window.pageYOffset > sticky-110) {
            header.classList.add("sticky");
            } else {
            header.classList.remove("sticky");
            }
            }
        },
        methods: {
            
        },
        computed: {
            
        }
    }
</script>

<style scoped>

.v-badge__badge{
    padding:15px;
  min-height:60px;
  min-width:60px;
}
.v-card__title {
    min-height:150px;
    max-height:150px;
}
.v-card__actions {
    height:50px;
}

a {  text-decoration: none;}
.navCatLink { transition: all .3s ease-in-out;
margin-left:5px;
margin-right:5px; }
.navCatLink:hover { transform: scale(1.3); }

/* Style the header */
.categoryPart {
    min-height:50vh;
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
    }
/* The sticky class is added to the header with JS when it reaches its scroll position */
.sticky {
  position: fixed;
  top: 110px;
  width: 100%;
  z-index:2;
}

/* Add some top padding to the page content to prevent sudden quick movement (as the header gets a new position at the top of the page (position:fixed and top:0) */


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

@media only screen 
and (max-device-width : 375px) 
{ 
    .hero-section {
    height: 600px;
    background-image: url('/img/header_shop_mobile.jpg');
    align-items: center;
    margin-top: -20px;
    }
    .sticky + .content {
    padding-top:200px;
    }
}
@media only screen 
and (min-device-width : 812px) 
{ 
    .hero-section {
        height: 850px;
        background-image: url('/img/header_shop.jpg');
        align-items: center;
        margin-top: -20px;
    }
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