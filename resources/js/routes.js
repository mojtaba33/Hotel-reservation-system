import VueRouter from 'vue-router';

import Bookable from "./components/Bookables/Bookable";

const routes = [
    { path: '/', component: Bookable , name : "home" },
];

const router = new VueRouter({
    mode: 'history',
    routes,
});

export default router;