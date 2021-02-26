<template>
  <div>
    <nav class="navbar homeNav navbar-expand-md navbar-dark navbar-laravel grey darken-4 fixed-top">
      <div class="container">
        <img class="mr-2" src="/img/logo_white.png" alt="logo IOPhoto" />
        <router-link :to="{name: 'home'}" class="navbar-brand title">IO.Photo</router-link>
        <button
          class="navbar-toggler"
          type="button"
          data-toggle="collapse"
          data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Left Side Of Navbar -->
          <ul class="navbar-nav mr-auto"></ul>
          <!-- Right Side Of Navbar -->
          <ul class="navbar-nav ml-auto">
            <router-link :to="{ name: 'shop' }" class="nav-link white--text">🎁 Boutique</router-link>
            <router-link :to="{ name: 'about' }" class="nav-link white--text">📰 A propos</router-link>
            <button
              data-toggle="modal"
              data-target="#cart"
              class="nav-link white--text"
            >🛒 Shopping Cart ({{badges}})</button>
            <router-link
              :to="{ name: 'login' }"
              class="nav-link white--text"
              v-if="!isLoggedIn"
            >🔒 Connexion</router-link>
            <router-link :to="{ name: 'register' }" class="nav-link white--text" v-if="!isLoggedIn"></router-link>
            <span v-if="isLoggedIn">
              <router-link
                :to="{ name: 'userboard' }"
                class="nav-link white--text"
                v-if="user_type == 0"
              >🤷‍♂ Hi, {{name}}</router-link>
              <router-link
                :to="{ name: 'admin' }"
                class="nav-link white--text"
                v-if="user_type == 1"
              >🧙‍ Hi, {{name}}</router-link>
            </span>
            <li class="nav-link white--text" v-if="isLoggedIn" @click="logout">⛔️ Logout</li>
          </ul>
        </div>
      </div>
    </nav>
    <main class>
      <div class="modal fade" id="cart">
        <div class="modal-dialog modal-dialog-centered modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Your Shopping Cart</h5>
              <button class="close" data-dismiss="modal"></button>
            </div>
            <div class="modal-body">
              <table class="table table-striped text-left">
                <tbody>
                  <tr v-for="(cart, n) in carts" v-bind:key="cart.id" :index="n">
                    <td>
                      <img class="img_cart" :src="cart.image" alt="image_product" />
                    </td>
                    <td>{{cart.name}}</td>
                    <td>{{cart.price}} €</td>
                    <td>
                      <input type="text" readonly class="form-control" v-model="cart.quantity" />
                    </td>
                    <td>
                      <button @click="removeCart(n)" class="btn btn-danger white--text">X</button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="modal-footer">
              Total Price : {{totalprice}} €
              <br />
              <router-link :to="'/checkout'" data-dismiss="modal">
                <v-btn raised hover class="teal dark-darken-3 white--text">Valider le panier</v-btn>
              </router-link>
            </div>
          </div>
        </div>
      </div>
      <router-view @loggedIn="change"></router-view>
    </main>

    <v-footer dark height="auto">
      <v-card class="flex" flat tile>
        <v-card-title class="teal">
          <strong class="subheading">Get connected with us on social networks!</strong>

          <v-spacer></v-spacer>

          <v-btn v-for="icon in icons" :key="icon" class="mx-3" dark icon>
            <v-icon size="24px">{{ icon }}</v-icon>
          </v-btn>
        </v-card-title>

        <v-card-actions class="grey darken-3 justify-center">
          &copy;2019 —
          <strong>IO.Photo</strong>
        </v-card-actions>
      </v-card>
    </v-footer>
  </div>
</template>
<script>
export default {
  data() {
    return {
      name: null,
      user_type: 0,
      isLoggedIn: localStorage.getItem("IophotoStore.jwt") != null,
      carts: JSON.parse(localStorage.getItem("IophotoStore.carts")),

      icons: [
        "fa fa-facebook",
        "fa fa-twitter",
        "fa fa-google-plus",
        "fa fa-linkedin",
        "fa fa-instagram"
      ],
      badges: JSON.parse(localStorage.getItem("IophotoStore.carts").length)
    };
  },
  beforeMount() {
    if (this.isLoggedIn) {
      let user = JSON.parse(localStorage.getItem("IophotoStore.user"));
      let carts = JSON.parse(localStorage.getItem("IophotoStore.carts"));
      let badges = JSON.parse(localStorage.getItem("IophotoStore.carts"))
        .length;
      this.name = user.name;
      this.user_type = user.is_admin;
    }
  },
  mounted() {
    this.setDefaults();
  },
  computed: {
    totalprice() {
      let totalprice = 0;
      if (localStorage.getItem("IophotoStore.carts") != null) {
        this.carts.forEach(e => {
          totalprice += e.price;
        });
        return totalprice;
      }
    }
  },
  watch: {},
  methods: {
    setDefaults() {
      if (this.isLoggedIn) {
        let user = JSON.parse(localStorage.getItem("IophotoStore.user"));
        let carts = JSON.parse(localStorage.getItem("IophotoStore.carts"));
        let badges = JSON.parse(localStorage.getItem("IophotoStore.carts"))
          .length;
        this.name = user.name;
        this.user_type = user.is_admin;
      }
    },
    closeModal() {
      document.querySelector("#cart").modal("hide");
    },
    viewCart() {
      if (localStorage.getItem("IophotoStore.carts") != null) {
        this.carts = JSON.parse(localStorage.getItem("IophotoStore.carts"));
        this.badges = this.carts.length;
      }
    },
    removeCart(product) {
      this.carts.splice(product, 1);
      this.storeCart();
    },
    storeCart() {
      let parsed = JSON.stringify(this.carts);
      localStorage.setItem("IophotoStore.carts", parsed);
      this.viewCart();
    },
    change() {
      this.isLoggedIn = localStorage.getItem("IophotoStore.jwt") != null;
      this.setDefaults();
    },
    logout() {
      localStorage.removeItem("IophotoStore.jwt");
      localStorage.removeItem("IophotoStore.user");
      localStorage.removeItem("IophotoStore.carts");
      localStorage.removeItem("carts");
      this.change();
      window.location.assign("/");
    }
  }
};
</script>
<style>
.homeNav {
  min-height: 110px;
  max-height: 110px;
}
.nav-link {
  cursor: pointer;
}
.img_cart {
  width: 100px;
  height: 100px;
}
</style>
