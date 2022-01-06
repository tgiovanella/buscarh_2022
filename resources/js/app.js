/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

//bibliotecas

import JqueryConfirm from 'jquery-confirm';
Vue.use(JqueryConfirm);

import Slick from 'vue-slick';
Vue.use(Slick);


// import Parallax from 'jquery-parallax.js';
// Vue.use(Parallax);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */


// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

Vue.component('banner-full', require('./components/BannerFullComponent.vue').default);

Vue.component('banner-slide-logo', require('./components/BannerSlideLogoComponent.vue').default);

Vue.component('banner-slide-cloud', require('./components/BannerCloudComponent.vue').default);

Vue.component('banner-slide-sidebar', require('./components/BannerSidebarComponent.vue').default);


//formulário de anúncio
Vue.component('advertise-create', require('./components/advertise/CreatePage.vue').default);

//checkout transparente
Vue.component('checkout-pagseguro', require('./components/advertise/CheckoutPagseguro.vue').default);

import VueWait from "vue-wait";
Vue.use(VueWait)



/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',

    wait: new VueWait(),


    data() {
        return {
            term: null
        };
    },

    components: { Slick },


    methods: {
        analytics: function () {

            axios.get("/api/analytics/seach?term=" + this.term).then(response => {
                this.banners = response.data;
            });
        }
    },

    filters: {

    },


});
