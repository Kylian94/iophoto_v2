<template>
        <div class="container marginNav">
            <v-layout>
                <v-layout justify-center wrap>

                    <v-flex md6 s12 sm12>
                    <v-img src="https://picsum.photos/200/250?grayscale" :alt="product.name + ' image'" :aspect-ratio="1"></v-img>
                    </v-flex>

                    <v-flex md6 xs12 sm12>
                        <v-img  :src="product.image" :alt="product.name + ' image'" :aspect-ratio="1"></v-img>
                    </v-flex>

                    <v-flex md6 xs12 sm12>
                    <v-img src="https://picsum.photos/200/300?grayscale" :alt="product.name + ' image'" :aspect-ratio="1"></v-img>
                    </v-flex>
                    
                    <v-flex md6 xs12 sm12>
                    <v-img src="https://picsum.photos/250/300?grayscale" :alt="product.name + ' image'" :aspect-ratio="1"></v-img>
                    </v-flex>

                </v-layout>    
                <v-flex md5 xs12 sm12 column pa-4>
                    <v-layout justify-space-between align-center>
                        <h3 class="title" v-html="product.name"></h3>
                        <p class="small-text text-muted">{{product.price}} €</p>
                    </v-layout>
                    <div v-if="product.name == ('T-shirt Homme' || 'T-shirt Femme')">
                        <p class="subheading">Choisissez votre taille</p>
                        <v-layout wrap class="mb-3">
                            <v-btn  hover class="white grey--text title mx-0 my-1">S</v-btn>
                            <v-btn  hover class="white grey--text title mx-2 my-1">M</v-btn>
                            <v-btn  hover class="white grey--text title mx-2 my-1">L</v-btn>
                            <v-btn  hover class="white grey--text title ma-0 my-1">XL</v-btn>
                        </v-layout>
                    </div>
                    <router-link :to="{ path: '/customisation?pid='+product.id }" class="m-0">
                        <v-btn class="teal darken-2 white--text mx-0 mb-3" raised hover>Personnaliser le votre !</v-btn>
                    </router-link>
                    <v-flex md10>
                        <p class="texte-muted">{{product.description}}</p>
                        <p class="texte-muted">⚠️ Article vierge à personnaliser</p>
                    </v-flex>
                    <v-expansion-panel>
                        <v-expansion-panel-content>
                        <template v-slot:header>
                            <div class="title font-weight-light">🚚 Livraion et retours gratuits</div>
                        </template>
                        <v-card>
                            <v-card-text>
                                <span class="subheading">Livraison standard gratuite avec votre compte IO.Photo.</span><br><br>

                                ⚫️ Le délai des livraisons standard est de 2 à 4 jours ; nous effectuons des livraisons 5 jours sur 7.<br><br>
                                ⚫️ Pour une commande passée avant 13 heures avec option de livraison le lendemain, du lundi au jeudi.<br><br>
                                ⚫️ Possibilité de retirer les commandes en magasin IO.Photo et dans une centaine de points de retrait faciles d'accès.<br><br>
                                ⚫️ Vous pouvez retourner votre commande gratuitement, quelle que soit la raison, dans un délai de 30 jours.
                            </v-card-text>
                        </v-card>
                        </v-expansion-panel-content>
                    </v-expansion-panel>
                    <v-expansion-panel >
                        <v-expansion-panel-content>
                        <template v-slot:header>
                            <div class="title font-weight-light">🌍 Eco-responsable</div>
                        </template>
                        <v-card>
                            <v-card-text>
                                Les produits recyclables IO.Photo vendus en France disposent du logo de recyclage Triman. Il s'agit d'une exigence juridique pour les revendeurs opérant sur le marché français, depuis le 1er janvier 2015.<br><br>

                                Cela signifie que les produits recyclables que vous vendons sont soumis juridiquement à la collecte sélective des déchets (conformément au système français de « Responsabilité élargie du producteur » (REP)).
                            </v-card-text>
                        </v-card>
                        </v-expansion-panel-content>
                    </v-expansion-panel>
                    <p class="subheading font-weight-light my-2">♻️ Ce produit peut être recyclé.</p>
                    
                </v-flex>
            </v-layout>
            <v-layout class="mt-4" justify-center align-center flex-column>
                    <h1 class="title mt-4 mx-auto">Découvrez <span v-if="product.name == 'Serviette XXL'">la</span><span v-else>le</span> {{product.name}}</h1>
                    <p class="title mx-auto mt-3">∨</p>
            </v-layout>
            <v-layout class="container" justify-center>
                <v-flex md6 xs12 sm12>
                    <v-img :src="product.image"></v-img>
                </v-flex>
            </v-layout>
            <v-layout class="mt-4" justify-center align-center flex-column >
                <h1 class="title mt-4 mx-auto">Personnalisez <span v-if="product.name == 'Serviette XXL'">la</span><span v-else>le</span></h1>
                <v-flex md6 xs12 sm12>
                <p class="subheading font-weight-light mx-auto mt-3 text-center" >Le {{product.name}} est vierge et à personnaliser. Sélectionnez vos plus belles photos et appliquez les sur votre support.</p>
                </v-flex>
            </v-layout>
            <v-layout class="mt-4">
                <h4 class="title mt-3">Vous aimerez peut-être aussi</h4>
            </v-layout>
            <v-layout class="container" wrap>
                <v-flex md3 xs6 sm6 v-for="(product, index) in products" v-bind:key="index">
                    
                    <a :href="'/products/'+product.id">
                        <v-layout flex-column align-center>
                            <v-img class="list_products" :src="product.image"></v-img>
                            <p class="subheading">{{product.name}}</p>
                        </v-layout>
                    </a>
                    
                </v-flex>
            </v-layout>
        </div>
    </template>

    <script>
    window.onunload = function(){ window.scrollTo(0,0); }
    window.onbeforeunload = function () {
                window.scrollTo(0, 0);
                }
    export default {
        data(){
            return {
                product : [],
                products : [],
            }
        },
        beforeMount(){
            
            let url = `/api/products/${this.$route.params.id}`
            axios.get(url).then(response => this.product = response.data)   
            let url_products = `/api/products/`
            axios.get(url_products).then(response => this.products = response.data)  
        }
    }
    </script>

    <style scoped>
    .small-text { font-size: 18px; }
    .img_page {
        height:250px;
        width:250px;
    }
    .title { font-size: 36px; }
    .list_products {
        height:150px;
        width: 150px;
    }
    </style>