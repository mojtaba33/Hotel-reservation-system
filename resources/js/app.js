require('./bootstrap');
window.Vue = require('vue').default;

import VueRouter from 'vue-router';
import router from './routes';
import moment from 'moment';

import Index from "./Index";
import StarRating from "./components/global/StarRating";

Vue.filter('fromNow', function (value) {
    return moment(value).fromNow();
});

Vue.component("star-rating", StarRating);

Vue.use(VueRouter);

const app = new Vue({
    el: '#app',
    router,
    components:{
        Index
    }
});
