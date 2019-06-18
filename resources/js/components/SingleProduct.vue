<template>
        <div class="container marginNav">
            <v-layout justify-center wrap>
                <v-flex md4 xs12 sm12>
                    <v-img :src="product.image" :alt="product.name + ' image'" :aspect-ratio="1"></v-img>
                </v-flex>
                <v-flex md4 xs12 sm12 column pa-4>
                    <h3 class="title" v-html="product.name"></h3>
                    <v-flex md7>
                        <p class="texte-muted">{{product.description}}</p>
                    </v-flex>
                    <p class="small-text text-muted">{{product.price}} €</p>
                    <router-link :to="{ path: '/customisation?pid='+product.id }" class="m-0">
                        <v-btn class="teal darken-2 white--text ma-0" raised hover>Custom your own</v-btn>
                    </router-link>
                    
                </v-flex>
            </v-layout>
        </div>
    </template>

    <script>
    export default {
        data(){
            return {
                product : []
            }
        },
        beforeMount(){
            let url = `/api/products/${this.$route.params.id}`
            axios.get(url).then(response => this.product = response.data)      
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
    </style>