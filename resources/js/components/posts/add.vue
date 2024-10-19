<template>
    <form @submit.prevent="createPost" class="max-w-sm mx-auto">

        <div v-if="successMessage" class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
            <span class="font-medium">{{ successMessage }}</span>
        </div>

        <div class="flex flex-wrap justify-between">
            <h1 class="text-2xl font-bold text-center my-2">Add Post</h1>
            <router-link to="/posts">
                <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Back</button>
            </router-link>
        </div>
        <div class="mb-5">
            <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Post Title</label>
            <input 
                type="text" 
                id="title" 
                v-model="model.post.title" 
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                placeholder="Enter post title" 
                required 
            />
        </div>
        <div class="mb-5">
            <label for="content" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Post Content</label>
            <textarea 
                id="content" 
                v-model="model.post.content" 
                rows="4" 
                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                placeholder="Your content..." 
                required
            ></textarea>
        </div>
        <button 
            type="submit" 
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
        >
            Submit
        </button>
    </form>
</template>

<script>
import axios from "axios";
const url = 'http://127.0.0.1:8000/api/posts';

export default {
    name: 'posts',
    data() {
        return {
            posts: [],
            model: {
                post: {
                    title: '',
                    content: ''
                }
            },
            successMessage: ''
        };
    },
    methods: {   
        async createPost() {
            try {
                const response = await axios.post(url, this.model.post);   
                this.posts.push(response.data); 
                this.model.post = { title: '', content: '' };
                this.successMessage = response.data.message

                setTimeout(() => {
                    this.successMessage = '';
                    window.location.href = "/posts";
                }, 3000);
                
            } catch (error) {
                console.error('Error creating post:', error);
            }
        }
    }
};
</script>