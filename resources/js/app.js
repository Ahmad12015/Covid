/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
window.Vue = require('vue');

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('patient-table-component', require('./components/PatientTableComponent.vue').default);
Vue.component('place-table-component', require('./components/placeTableComponent').default);
Vue.component('user-table-component', require('./components/UserTableComponent').default);

const app = new Vue({
    el: '#app',
});
