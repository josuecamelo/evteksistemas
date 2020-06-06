require('./bootstrap');

window.Vue = require('vue');

import Snotify from 'vue-snotify';
import router from './routes/routers'
import store from './vuex/store'
import VueTheMask from 'vue-the-mask'

Vue.use(Snotify, {toast: {showProgressBar: false}})
Vue.use(VueTheMask)

Vue.component('admin-component', require('./components/admin/AdminComponent').default);

const app = new Vue({
    router,
    store,
    el: '#app',
});
