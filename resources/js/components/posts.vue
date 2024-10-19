<template>
    <div class="flex items-center justify-center">
        <div class="w-3/4 md:w-1/2 lg:w-3/4 sm:w-full">
            <div v-if="successMessage" class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                <span class="font-medium">{{ successMessage }}</span>
            </div>
            <div class="flex justify-between">
                <h1>Post Application</h1>
                <div class="flex gap-2 items-center border p-2">
                    <router-link to="/posts/add">
                        <button 
                            type="button" 
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-xs px-3 py-1.5 me-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                        >
                            Add
                        </button>
                    </router-link>

                    <form class="flex items-center max-w-lg mx-auto w-full">
                        <input 
                            type="email" 
                            id="email" 
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                            placeholder="Enter post to search..." 
                            required 
                        />
                        <button 
                            type="button" 
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-xs px-3 py-1.5 ms-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                        >
                            Search
                        </button>
                    </form>
                </div>

                <button 
                    v-if="selectedPosts.length" 
                    @click="deleteSelectedPosts" 
                    type="button" 
                    class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800">
                    Delete Selected
                </button>
            </div>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                <input type="checkbox" @change="toggleSelectAll($event)" />
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Title
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Content
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr 
                            v-for="post in posts" 
                            :key="post.id" 
                            class="odd:bg-white odd:dark:bg-gray-900 hover:bg-gray-100 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 cursor-pointer" 
                            @click="navigateToEdit(post.id)"
                        >
                            <td class="px-6 py-4">
                                <input 
                                    type="checkbox" 
                                    :value="post.id" 
                                    v-model="selectedPosts"
                                    @click.stop
                                />
                            </td>
                            <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ post.title }}
                            </td>
                            <td class="px-6 py-4">
                                {{ post.content }}
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
    name: 'posts',
    data() {
        return {
            posts: [],
            selectedPosts: [], 
            successMessage: ''
        };
    },
    created() {
        this.fetchPosts();
    },
    methods: {
        async fetchPosts() {
            try {
                const response = await axios.get(url);
                this.posts = response.data.posts;
            } catch (error) {
                console.error(error);
            }
        },
        async deleteSelectedPosts() {
            for (const postId of this.selectedPosts) {
                await axios.delete(`${url}/${postId}`);
            }
            this.selectedPosts = []; 
            this.fetchPosts(); 

            this.successMessage = 'Post/s deleted';
            setTimeout(() => {
                this.successMessage = '';
            }, 3000);
        },
        toggleSelectAll(event) {
            this.selectedPosts = event.target.checked ? this.posts.map(post => post.id) : [];
        },
        navigateToEdit(id) {
            this.$router.push({ path: `posts/${id}/view` });
        },
    }
};
</script>