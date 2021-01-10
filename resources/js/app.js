require('./bootstrap');
window.Vue = require('vue').default;

import VueRouter from 'vue-router';
import router from './routes';

Vue.use(VueRouter);

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

const app = new Vue({
    el: '#app',
    router,
});
