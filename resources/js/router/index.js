import { createRouter, createWebHistory } from "vue-router";

import index from '../components/index.vue';
import posts from '../components/posts.vue';
import notfound from '../components/404.vue';
import add from '../components/posts/add.vue';
import edit from '../components/posts/edit.vue';
import view from '../components/posts/view.vue';

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
        path: '/posts/add',
        component: add
    },
    {
        path: '/posts/:id/edit',
        component: edit
    },
    {
        path: '/posts/:id/view',
        component: view
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