import Vue from 'vue'

    import VueRouter from 'vue-router'
    import Vuetify from 'vuetify'
    import vueSmoothScroll from 'vue2-smooth-scroll'
    import Affix from 'vue-affix';

    Vue.use(Affix);
    Vue.use(vueSmoothScroll)
    Vue.use(Vuetify)
    Vue.use(VueRouter)

    import App from './components/App.vue'
    import Home from './components/Home.vue'
    import Shop from './components/Shop.vue'
    import Login from './components/Login.vue'
    import Register from './components/Register.vue'
    import SingleProduct from './components/SingleProduct.vue'
    import Checkout from './components/Checkout.vue'
    import Confirmation from './components/Confirmation.vue'
    import UserBoard from './components/UserBoard.vue'
    import Admin from './components/Admin.vue'

    const router = new VueRouter({
        mode: 'history',
        routes: [
            {
                path: '/',
                name: 'home',
                component: Home
            },
            {
                path: '/shop',
                name: 'shop',
                component: Shop
            },
            {
                path: '/login',
                name: 'login',
                component: Login
            },
            {
                path: '/register',
                name: 'register',
                component: Register
            },
            {
                path: '/products/:id',
                name: 'single-products',
                component: SingleProduct
            },
            {
                path: '/confirmation',
                name: 'confirmation',
                component: Confirmation
            },
            {
                path: '/checkout',
                name: 'checkout',
                component: Checkout,
                props: (route) => ({ pid: route.query.pid })
            },
            {
                path: '/dashboard',
                name: 'userboard',
                component: UserBoard,
                meta: {
                    requiresAuth: true,
                    is_user: true
                }
            },
            {
                path: '/admin/:page',
                name: 'admin-pages',
                component: Admin,
                meta: {
                    requiresAuth: true,
                    is_admin: true
                }
            },
            {
                path: '/admin',
                name: 'admin',
                component: Admin,
                meta: {
                    requiresAuth: true,
                    is_admin: true
                }
            },
        ],
    })

    router.beforeEach((to, from, next) => {
        if (to.matched.some(record => record.meta.requiresAuth)) {
            if (localStorage.getItem('IophotoStore.jwt') == null) {
                next({
                    path: '/login',
                    params: { nextUrl: to.fullPath }
                })
            } else {
                let user = JSON.parse(localStorage.getItem('IophotoStore.user'))
                if (to.matched.some(record => record.meta.is_admin)) {
                    if (user.is_admin == 1) {
                        next()
                    }
                    else {
                        next({ name: 'userboard' })
                    }
                }
                else if (to.matched.some(record => record.meta.is_user)) {
                    if (user.is_admin == 0) {
                        next()
                    }
                    else {
                        next({ name: 'admin' })
                    }
                }
                next()
            }
        } else {
            next()
        }
    })

    const app = new Vue({
        el: '#app',
        components: { App },
        router,
    });
