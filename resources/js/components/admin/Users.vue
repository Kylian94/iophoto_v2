<template>
        <v-layout align-center justify-center>
            <v-flex>
                <button class="btn btn-primary m-2" @click="newUser">Add New User</button>
                <br>
                <table class="table table-responsive table-striped">
                    <thead>
                        <tr>
                            <td></td>
                            <td>Name</td>
                            <td>Email</td>
                            <td>Is admin ?</td>
                            <td>Joined</td>
                            <td>Total Orders</td>
                            <td>Actions</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="text-xs-center text-md-center" v-for="(user,index) in users" v-bind:key="index">
                            <td>{{index+1}}</td>
                            <td v-model="user.name">{{user.name}}</td>
                            <td v-model="user.email">{{user.email}}</td>
                            <td v-model="user.is_admin" v-if="user.is_admin == 1">Admin</td>
                            <td v-else >User</td>
                            <td>{{user.created_at}}</td>
                            <td v-if="user.orders">{{user.orders.length}}</td>
                            <td v-else>0</td>
                            <td>
                                <v-btn @click="editingUser = user" raised color="teal darken-1">
                                    <i class="fa fa-cog white--text" aria-hidden="true"></i>
                                </v-btn>
                                <v-btn raised color="red darken-1" @click.prevent="deleteUser(user)">
                                    <i class="fa fa-times white--text" aria-hidden="true"></i>
                                </v-btn>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <modal @close="endEditing" :user="editingUser" v-show="editingUser != null"></modal>
                <modal @close="addUser"  :user="addingUser" v-show="addingUser != null"></modal>
            </v-flex>
        </v-layout>
        
    </template>

    <script>
    import Modal from './UserModal'

    export default {
        data() {
            return {
                users : [], 
                editingUser: null,
                addingUser: null,
                
                
            }
        },
        components: {Modal},
        beforeMount() {
            axios.get('/api/users').then(response => this.users = response.data)
            
        }, 
        methods: {

            newUser() {
                this.addingUser = {
                    name: null,
                    email: null,
                    password: null,
                    is_admin: null,
                }
            }, 

            endEditing(user) {
                this.editingUser = null

                let index = this.users.indexOf(user)
                let name = user.name
                let email = user.email
                let password = user.password
                let is_admin = user.is_admin
            
                axios.patch(`/api/users/${user.id}`, {name, email, password, is_admin})
                     .then(response => this.users[index] = user)
            },

            deleteUser(user) {
            let usr = this.users.indexOf(user)

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

                            axios.delete('/api/users/' + user.id)
                            .then(this.users.splice(usr, 1))

                            swal.fire(
                            'Deleted!',
                            'User has been deleted.',
                            'success'
                            )
                        }
                    })


            // axios.delete('/api/users/' + user.id)
            //     .then(this.users.splice(usr, 1))
            //     .then(toast.fire({
            //         type: 'success',
            //         title: 'User deleted'
            //     }))
            },

            addUser(user) {
                this.addingUser = null

                let name = user.name
                let email = user.email
                let password = user.password
                let is_admin = user.is_admin
                

            
                axios.post("/api/users/", {name, email, password, is_admin})
                     .then(response => this.users.push(user))
                     .then(toast.fire({ type: 'success', title: 'User has been created'}))
                     
            },
        },
        
    }
    </script>