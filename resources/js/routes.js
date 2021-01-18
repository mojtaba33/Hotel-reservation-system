import VueRouter from 'vue-router';

import Bookable from "./components/Bookables/Bookable";
import ShowBookable from "./components/Bookable/ShowBookable";

const routes = [
    { path: '/', component: Bookable , name : "home" },
    { path: '/bookable/:slug', component: ShowBookable , name : "bookable-show" },
];

const router = new VueRouter({
    mode: 'history',
    routes,
});

export default router;