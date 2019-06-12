<template>
    <div>
        <nav class="navbar homeNav navbar-expand-md navbar-dark navbar-laravel grey darken-4 fixed-top">
            
                <img class="mr-2" src="/img/logo_white.png" alt="logo IOPhoto">
                <router-link :to="{name: 'home'}" class="navbar-brand title">IO.Photo</router-link>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto"></ul>
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <router-link :to="{ name: 'shop' }" class="nav-link white--text">🎁 Boutique</router-link>
                        <router-link :to="{ name: 'a-propos' }" class="nav-link white--text">📰 A propos</router-link>
                        <router-link :to="{ name: 'login' }" class="nav-link white--text" v-if="!isLoggedIn">🔒 Connexion</router-link>
                        <router-link :to="{ name: 'register' }" class="nav-link white--text" v-if="!isLoggedIn"></router-link>
                        <span v-if="isLoggedIn">
                            <router-link :to="{ name: 'userboard' }" class="nav-link white--text" v-if="user_type == 0"> Hi, {{name}}</router-link>
                            <router-link :to="{ name: 'admin' }" class="nav-link white--text" v-if="user_type == 1">🧙‍ Hi, {{name}}</router-link>
                        </span>
                        <li class="nav-link white--text" v-if="isLoggedIn" @click="logout">⛔️ Logout</li>
                    </ul>
                </div>
            
        </nav>
        <main class="py-4">
            <router-view @loggedIn="change"></router-view>
        </main>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                name: null,
                user_type: 0,
                isLoggedIn: localStorage.getItem('IophotoStore.jwt') != null
            }
        },
        mounted() {
            this.setDefaults()
        },
        methods : {
            setDefaults() {
                if (this.isLoggedIn) {
                    let user = JSON.parse(localStorage.getItem('IophotoStore.user'))
                    this.name = user.name
                    this.user_type = user.is_admin
                }
            },
            change() {
                this.isLoggedIn = localStorage.getItem('IophotoStore.jwt') != null
                this.setDefaults()
            },
            logout(){
                localStorage.removeItem('IophotoStore.jwt')
                localStorage.removeItem('IophotoStore.user')
                this.change()
                this.$router.push('/')
            }
        }
    }
</script>
<style>
.homeNav {
    min-height:110px;
    max-height:110px;
}
.nav-link {
    cursor:pointer;
}
</style>
