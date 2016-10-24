
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the body of the page. From here, you may begin adding components to
 * the application, or feel free to tweak this setup for your needs.
 */
import VueRouter from 'vue-router'
import Vuex from 'vuex'

Vue.use(VueRouter)
Vue.use(Vuex)

import Directory from './components/Directory.vue'
import Photopreview from './components/Photopreview.vue'

// Awesome Vue Router in action!
const routes = [
    { path: '/', component: Directory },
    { path: '/photopreview', component: Photopreview },
]

//We use this as public store to pass around data between Components
const store = new Vuex.Store({
    state: {
        photoData: []
    },
    mutations: {
        setphoto(state, payload) {
            state.photodata = payload;     
        }
    }
});

var router = new VueRouter({
    routes
})

// Inject both router and store so child Components may access them.
const app = new Vue({
  router, store
}).$mount('#app')
