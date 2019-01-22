require("./bootstrap")
import Vue from "vue"
import Vuex from "vuex"
import Vuetify from 'vuetify'
import VueRouter from "vue-router"
import VueTrix from 'vue-trix'
import VueSweetalert2 from 'vue-sweetalert2'
import Loading from 'vue-loading-overlay'

import App from "./components/Main.vue"
import store from "./store"

import { routes } from "./routes"
import { initialize } from "./helpers/interceptor"

import 'vuetify/dist/vuetify.min.css'
import '@mdi/font/css/materialdesignicons.css'
// import '@fortawesome/fontawesome-free/css/all.min.css'

Vue.use(Vuex)
Vue.use(VueRouter)
Vue.use(VueSweetalert2)
Vue.use(Vuetify, { iconfont: 'mdi' })
Vue.use(VueTrix)
Vue.use(Loading)

const router = new VueRouter({
    routes,
    mode: "history"
})

initialize(store, router)

new Vue({
    router,
    store,
    el: "#app",
    render: app => app(App)
})
