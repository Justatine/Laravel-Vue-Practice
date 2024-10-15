<template>
    <h1>CRUD App</h1>
    <form @submit.prevent="createPost">
        <input v-model="model.post.title" placeholder="Title" required>
        <textarea v-model="model.post.content" placeholder="Content" required></textarea>
        <button type="submit">Create Post</button>
    </form>

    <div class="flex items-center justify-center">
        <div class="w-3/4 md:w-1/2 lg:w-3/4 sm:w-full">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Title
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Content
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Edit
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Delete
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="post in posts" :key="post.id" class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                            <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ post.title }}
                            </td>
                            <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ post.content }}
                            </td>
                            <td class="px-6 py-4">
                                <button @click="editPost(post)" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">View</button>
                            </td>
                            <td class="px-6 py-4">
                                <button @click="deletePost(post.id)" type="button" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>
<script>
import axios from 'axios';
const url = 'http://127.0.0.1:8000/api/posts';

export default {
    name:'posts',
    data(){
        return {
            posts: [],
            model: {
                post: {
                    title: '',
                    content: ''
                }
            }
        }
    },
    created(){
        this.fetchPosts();
    },
    methods:{
        async fetchPosts(){ 
            await axios.get(url).then(response => {
                this.posts = response.data.posts;
                // console.log(this.posts)
            }).catch(error => {
                console.log(error)
            });
        },
        async createPost() {
            const response = await axios.post(url, this.model.post);
            this.posts.push(response.data); 
            this.model.post = { title: '', content: '' };

            // await axios.post(`${url}`, this.post);
            // this.post = { title: '', content: '' };
            
            this.fetchPosts();
        },
        async editPost(post) {
            this.model.post = { ...post }; 
        },
        async deletePost(id) {
            await axios.delete(`${url}/${id}`);
            this.fetchPosts();
        }
    },
    // mounted() {
    //     this.fetchPosts();
    // }
}
</script>