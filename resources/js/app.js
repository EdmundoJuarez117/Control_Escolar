/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
window.bootstrap = require('bootstrap/dist/js/bootstrap.bundle.js')

window.Vue = require('vue').default;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

import Vuelidate from "vuelidate";
Vue.use(Vuelidate);

//Vue.component('example-component', require('./components/ExampleComponent.vue').default);

Vue.component('toast-component', require('./components/toastComponent.vue').default);

Vue.component('grid-pagination-component', require('./components/GridPaginationComponent.vue').default);

Vue.component('modalidad-component', require('./components/ModalidadComponent.vue').default);

Vue.component('carrera-component', require('./components/CarreraComponent.vue').default);

Vue.component('planestudio-component', require('./components/PlanestudioComponent.vue').default);

Vue.component('escalaeval-component', require('./components/EscalaevalComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
