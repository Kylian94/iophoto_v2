    <template>
        <v-layout align-center justify-center>
            <v-flex>
                <button class="btn btn-primary m-2" @click="newProduct">Add New Product</button>
                <br>
                <table class="table table-responsive table-striped">
                    <thead>
                        <tr>
                            <td></td>
                            <td>Image</td>
                            <td>Product</td>
                            <td>Units</td>
                            <td>Price</td>
                            <td>Category</td>
                            <td>Description</td>
                            <td>Actions</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(product,index) in products" v-bind:key="index">
                            <td>{{index+1}}</td>
                            <td><img class="imgList" :src="product.image" alt="image produit"></td>
                            <td v-html="product.name"></td>
                            <td v-model="product.units">{{product.units}}</td>
                            <td v-model="product.price">{{product.price}}</td>
                            <td v-model="product.category_id"><p v-for="(category, index) in categories" v-bind:key="index" v-show="product.category_id == category.id">{{category.name}}</p></td>
                            <td v-model="product.price">{{product.description}}</td>
                            <td>
                                <v-btn @click="editingItem = product" raised color="teal darken-1">
                                    <i class="fa fa-cog white--text" aria-hidden="true"></i>
                                </v-btn>
                                <v-btn raised color="red darken-1" @click.prevent="deleteItem(product)">
                                    <i class="fa fa-times white--text" aria-hidden="true"></i>
                                </v-btn>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <modal @close="endEditing" :product="editingItem" v-show="editingItem != null"></modal>
                <modal @close="addProduct"  :product="addingProduct" v-show="addingProduct != null"></modal>
                
            </v-flex>
        </v-layout>
    </template>
    <script>
    import Modal from './ProductModal'

    export default {
        data() {
            return {
                products: [],
                categories: [],
                editingItem: null,
                addingProduct: null,
                
            }
        },
        components: {Modal},
        beforeMount() {
            axios.get('/api/products/').then(response => this.products = response.data)
            axios.get("/api/categories/").then(response => this.categories = response.data)
        },
        methods: {
            newProduct() {
                this.addingProduct = {
                    name: null,
                    units: null,
                    price: null,
                    description: null,
                    image: null,
                    category_id: null,
                }
            },
            endEditing(product) {
                this.editingItem = null

                let index = this.products.indexOf(product)
                let name = product.name
                let units = product.units
                let price = product.price
                let image = product.image
                let description = product.description
                let category_id = product.category_id

                axios.put(`/api/products/${product.id}`, {name, units, price, image, description, category_id})
                     .then(response => this.products[index] = product)
            },
            deleteItem(product) {
                let item = this.products.indexOf(product)
                swal.fire({
                            title: 'Are you sure?',
                            text: "You won't be able to revert this!",
                            type: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes, delete it!'
                            }).then((result) => {
                            if (result.value) {

                                axios.post('/api/products/' + product.id)
                                .then(this.products.splice(item, 1))

                                swal.fire(
                                'Deleted!',
                                'Your product has been deleted.',
                                'success'
                                )
                            }
                    })
            },
            addProduct(product) {
                this.addingProduct = null

                let name = product.name
                let units = product.units
                let price = product.price
                let description = product.description
                let image = product.image 
                let category_id = product.category_id

                axios.post("/api/products/", {name, units, price, description, image, category_id})
                     .then(response => this.products.push(product))
                     .then(toast.fire({ type: 'success', title: 'Product has been created'}))
            }
        }
    }
    </script>
    <style scoped>
    .imgList {
        max-width:100px;
        max-height:100px;
    }
    </style>
    