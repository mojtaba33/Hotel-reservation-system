import VueRouter from 'vue-router';

import Bookable from "./components/Bookables/Bookable";

const routes = [
    { path: '/', component: Bookable , name : "home" },
    { path: '/bookable/{:slug}', component: Bookable , name : "bookable.show" },
];

const router = new VueRouter({
    mode: 'history',
    routes,
});

export default router;