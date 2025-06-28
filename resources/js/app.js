
require('./bootstrap');

import Vue from 'vue';
import Vuetify from 'vuetify';
import 'vuetify/dist/vuetify.min.css'
import VueToast from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-sugar.css';
import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/vue-loading.css';
import pt from 'vuetify/lib/locale/pt'
import jQuery from 'jquery';
window.$ = jQuery;

Vue.use(Vuetify);
Vue.use(VueToast);
Vue.use(Loading);

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('navbar-vue', require('./components/navbar.vue').default);

Vue.component('p-login', require('./login.vue').default);

Vue.component('p-dashboard-index', require('./pages/dashboard/index.vue').default);
Vue.component('p-dashboard-charts', require('./pages/dashboard/charts.vue').default);

Vue.component('p-users-index', require('./pages/users/index.vue').default);
Vue.component('p-users-form', require('./pages/users/form.vue').default);

Vue.component('p-costumers-form', require('./pages/costumers/form.vue').default);
Vue.component('p-costumers-view', require('./pages/costumers/view.vue').default);
Vue.component('p-costumers-new-record', require('./pages/costumers/new-record.vue').default);

const app = new Vue({
    el: '#app',
    vuetify: new Vuetify({
        lang: {
            locales: { pt },
            current: 'pt',
        },
        icons: {
            iconfont: 'mdiSvg',
          },
    })
});
