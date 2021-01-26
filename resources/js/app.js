require('./bootstrap');
window.Vue = require('vue').default;

import VueRouter from 'vue-router';
import router from './routes';
import moment from 'moment';

import Index from "./Index";
import StarRating from "./components/global/StarRating";
import Success from "./components/global/Success";
import ValidationErrors from "./components/global/ValidationErrors";

Vue.filter('fromNow', function (value) {
    return moment(value).fromNow();
});

Vue.component("star-rating", StarRating);
Vue.component("success", Success);
Vue.component("validation-errors", ValidationErrors);

Vue.use(VueRouter);

const app = new Vue({
    el: '#app',
    router,
    components:{
        Index
    }
});
