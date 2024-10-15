import './bootstrap';

import { createApp } from 'vue';
import app from './components/app.vue';
import header from './components/header.vue';
import footer from './components/footer.vue';
import posts from './components/posts.vue';
import router from './router';

createApp(app).use(router).mount('#app');
createApp(header).use(router).mount('#header');
createApp(footer).mount('#footer');
createApp(posts).use(router).mount('#posts');