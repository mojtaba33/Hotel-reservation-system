import Vue from 'vue';
import Vuex from 'vuex';

import {availability} from './vuex madules/availability'

Vue.use(Vuex);

export const store = new Vuex.Store({
    modules: {
        availability
    }
});