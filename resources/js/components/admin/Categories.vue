    <template>
        <v-layout align-center justify-center>
            <v-flex>
                <button class="btn btn-primary m-2" @click="newCategory">Add New Category</button>
                <br>
                <table class="table table-responsive table-striped">
                    <thead>
                        <tr>
                            <td></td>
                            <td>Name</td>
                            <td>Actions</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(category,index) in categories" v-bind:key="index">
                            <td>{{index+1}}</td>
                            <td v-html="category.name" v-model="category.units">{{category.name}}</td>
                            <td>
                                <v-btn @click="editingItem = category" raised color="teal darken-1">
                                    <i class="fa fa-cog white--text" aria-hidden="true"></i>
                                </v-btn>
                                <v-btn raised color="red darken-1" @click.prevent="deleteItem(category)">
                                    <i class="fa fa-times white--text" aria-hidden="true"></i>
                                </v-btn>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <modal @close="endEditing" :category="editingItem" v-show="editingItem != null"></modal>
                <modal @close="addCategory"  :category="addingCategory" v-show="addingCategory != null"></modal>
                
            </v-flex>
        </v-layout>
    </template>
    <script>
    import Modal from './CategoryModal'

    export default {
        data() {
            return {
                
                categories: [],
                editingItem: null,
                addingCategory: null,
                
            }
        },
        components: {Modal},
        beforeMount() {
            
            axios.get("/api/categories/").then(response => this.categories = response.data)
        },
        methods: {
            newCategory() {
                this.addingCategory = {
                    name: null,
                    units: null,
                    price: null,
                    description: null,
                    image: null,
                    category_id: null,
                }
            },
            endEditing(category) {
                this.editingItem = null

                let index = this.categories.indexOf(category)
                let name = category.name
                
                axios.put(`/api/categories/${category.id}`, {name})
                     .then(response => this.categories[index] = category)
            },
            deleteItem(category) {
            let item = this.categories.indexOf(category)
            
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
                            
                             axios.post('/api/categories/' + category.id)
                            .then(this.categories.splice(item, 1))

                            swal.fire(
                            'Deleted!',
                            'Category has been deleted.',
                            'success'
                            )
                        }
                    })


           
            },
            addCategory(category) {
                this.addingCategory = null

                let name = category.name
                
                axios.post("/api/categories/", {name})
                     .then(response => this.categories.push(category))
                     .then(toast.fire({ type: 'success', title: 'Category has been created'}))
            }
        }
    }
    </script>
    <style scoped>
  
    </style>
    