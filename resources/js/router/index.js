import { createRouter, createWebHistory } from "vue-router";

import index from '../components/index.vue';
import posts from '../components/posts.vue';
import notfound from '../components/404.vue';

const routes = [
    {
        path: '/',
        component: index
    },
    {
        path: '/posts',
        component: posts
    },
    {
        path: '/:pathMatch(.*)*',
        component: notfound
    }
];

const router = createRouter({
    history: createWebHistory(),
    linkExactActiveClass: 'active',
    routes,
})

export default router;