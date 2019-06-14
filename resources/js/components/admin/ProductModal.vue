<template>
        <div class="modal-mask">
            <div class="modal-wrapper">
                <div class="modal-container">
                    <div class="modal-header">
                        <slot name="header" v-html="data.name"></slot>
                    </div>
                    <div class="modal-body">
                        <slot name="body">
                            <v-text-field v-model="data.name" label="Name"></v-text-field>
                            <v-text-field v-model="data.units" label="Units"></v-text-field>
                            <v-text-field v-model="data.price" label="Price"></v-text-field>
                            <p class="labelCat">Categories</p>
                            <div class="mdl-selectfield mb-4">
                                <select :categories="categories" v-model="data.category_id">
                                    <option  v-for="category in categories" v-bind:key="category.name" :value="category.id">{{ category.name }}</option>
                                </select>
                            </div>
                            <!-- <v-text-field v-model="data.category_id" label="Category"></v-text-field> -->
                            <v-textarea v-model="data.description" label="Description"></v-textarea>
                            <span >
                                <img class="img-modal" :src="data.image" v-show="data.image != null">
                                <input type="file" id="file" @change="attachFile">
                            </span>
                        </slot>
                    </div>
                    <div class="modal-footer">
                        <slot name="footer">
                            <button class="modal-default-button" @click="uploadFile">
                                Finish
                            </button>
                        </slot>
                    </div>
                </div>
            </div>
        </div>
    </template>

    <style scoped>
    .img-modal {
        max-width: 200px;
    }
    .modal-mask {
        position: fixed;
        z-index: 9998;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, .5);
        display: table;
        transition: opacity .3s ease;
    }
    .modal-wrapper {
        display: table-cell;
        vertical-align: middle;
    }
    .modal-container {
        width: 600px;
        margin: 0px auto;
        padding: 20px 30px;
        background-color: #fff;
        border-radius: 2px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, .33);
        transition: all .3s ease;
        font-family: Helvetica, Arial, sans-serif;
    }
    .modal-header h3 {
        margin-top: 0;
        color: #42b983;
    }
    .modal-body {
        margin: 20px 0;
    }
    .modal-default-button {
        float: right;
    }
    .modal-enter {
        opacity: 0;
    }
    .modal-leave-active {
        opacity: 0;
    }
    .modal-enter .modal-container,
    .modal-leave-active .modal-container {
        -webkit-transform: scale(1.1);
        transform: scale(1.1);
    }

    select {
  font-family: inherit;
  background-color: transparent;
  width: 100%;
  padding: 4px 0;
  font-size: 16px;
  color: rgba(0,0,0, .87);
  border: none;
  border-bottom: 1px solid rgba(0,0,0, 0.42);
}

/* Remove focus */
select:focus {
  outline: none;
}

/* Hide label */
.mdl-selectfield label {
  display: none;
}

/* Use custom arrow */
.mdl-selectfield select {
  -webkit-appearance: none;
     -moz-appearance: none;
          appearance: none;
}

.mdl-selectfield {
  position: relative;
}
.mdl-selectfield:after {
  position: absolute;
  top: 0.75em;
  right: 0.5em;
  /* Styling the down arrow */
  width: 0;
  height: 0;
  padding: 0;
  content: '';
  border-left: .25em solid transparent;
  border-right: .25em solid transparent;
  border-top: 0.375em solid rgba(0,0,0, 0.42);
  pointer-events: none;
}
.labelCat {
    color: rgba(0,0,0, 0.42);
    margin:0;
    padding:0;
}
    </style>
    <script>
    export default {
        props: ['product'],
        data() {
            return {
                attachment: null,
                categories: [],
                
            }
        },
        computed: {
            data: function() {
                if (this.product != null) {
                    return this.product
                    
                }
                return {
                    name: "",
                    units: "",
                    price: "",
                    category_id: "",
                    description: "",
                    image: false,
                    
                }
                console.log(data.category_id)
            }
            
            
        },
        beforeMount() {
            axios.get('/api/products/').then(response => this.products = response.data)
            axios.get("/api/categories/").then(response => this.categories = response.data)
        },
        methods: {
            attachFile(event) {
                this.attachment = event.target.files[0];
            },
            uploadFile(event) {
                if (this.attachment != null) {
                    // console.log(this.attachment)
                    var formData = new FormData();
                    formData.append("image", this.attachment)
                    let headers = {'Content-Type': 'multipart/form-data'}
                    axios.post("/api/upload-file", formData, {headers}).then(response => {
                        this.product.image = response.data
                        this.$emit('close', this.product)
                    })
                } else {
                    this.$emit('close', this.product)
                }
            },
            
        },
        mounted() {
            
        },
        created() {
           
        }, 
    }
    </script>