require('./bootstrap');
window.Vue = require('vue').default;

import VueRouter from 'vue-router';
import router from './routes';
import {store} from './store';
import moment from 'moment';

import Index from "./Index";
import StarRating from "./components/global/StarRating";
import Success from "./components/global/Success";
import ValidationErrors from "./components/global/ValidationErrors";
import FatalError from "./components/global/FatalError";

Vue.filter('fromNow', function (value) {
    return moment(value).fromNow();
});

Vue.component("star-rating", StarRating);
Vue.component("success", Success);
Vue.component("validation-errors", ValidationErrors);
Vue.component("fatal-error", FatalError);

Vue.use(VueRouter);

const app = new Vue({
    el: '#app',
    router,
    store,
    components:{
        Index
    },
    beforeCreate()
    {
        store.dispatch("auth/getUser");
    }
});
