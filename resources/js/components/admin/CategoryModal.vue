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
        props: ['category'],
        data() {
            return {
                attachment: null,
                
                
            }
        },
        computed: {
            data: function() {
                if (this.category != null) {
                    return this.category
                    
                }
                return {
                    name: "",
                    
                }
                
            }
            
            
        },
        beforeMount() {
            
            axios.get("/api/categories/").then(response => this.categories = response.data)
        },
        methods: {
            attachFile(event) {
                this.attachment = event.target.files[0];
            },
            uploadFile(event) {
                
                    this.$emit('close', this.category)
            },
            
            
        },
        mounted() {
            
        },
        created() {
           
        }, 
    }
    </script>