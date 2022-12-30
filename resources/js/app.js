
require('./bootstrap');

import Vue from 'vue';
import Vuetify from 'vuetify';
import 'vuetify/dist/vuetify.min.css'
import VueToast from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-sugar.css';
import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/vue-loading.css';

Vue.use(Vuetify);
Vue.use(VueToast);
Vue.use(Loading);

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

Vue.component('p-login', require('./login.vue').default);

Vue.component('p-dashboard-index', require('./pages/dashboard/index.vue').default);

Vue.component('p-users-index', require('./pages/users/index.vue').default);
Vue.component('p-users-create', require('./pages/users/create.vue').default);
Vue.component('p-users-edit', require('./pages/users/edit.vue').default);

const app = new Vue({
    el: '#app',
    vuetify: new Vuetify({})
});
