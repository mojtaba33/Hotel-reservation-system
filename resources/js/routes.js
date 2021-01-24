import VueRouter from 'vue-router';

import Bookable from "./components/Bookables/Bookable";
import ShowBookable from "./components/Bookable/ShowBookable";
import Review from "./components/Review/Review";

const routes = [
    { path: '/', component: Bookable , name : "home" },
    { path: '/bookable/:slug', component: ShowBookable , name : "bookable-show" },
    { path: '/review/:id', component: Review , name : "review-show" },
];

const router = new VueRouter({
    mode: 'history',
    routes,
});

export default router;