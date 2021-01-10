require('./bootstrap');
window.Vue = require('vue').default;

import VueRouter from 'vue-router';
import router from './routes';

import Index from "./Index";

Vue.use(VueRouter);

const app = new Vue({
    el: '#app',
    router,
    components:{
        Index
    }
});
