import Vue from 'vue';
import Vuex from 'vuex';

import {availability} from './vuex madules/availability';
import {basket} from './vuex madules/basket';

Vue.use(Vuex);

export const store = new Vuex.Store({
    modules: {
        availability,
        basket,
    }
});