<template>
    <form @submit.prevent="updatePost" class="max-w-sm mx-auto">
        <div v-if="successMessage" class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
            <span class="font-medium">{{ successMessage }}</span>
        </div>

        <div class="flex flex-wrap justify-between">
            <h1 class="text-2xl font-bold text-center my-2">Edit Post</h1>
            <router-link :to="`/posts/${model.post.id}/view`">
                <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Back</button>
            </router-link>
        </div>

        <div class="mb-5">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file">Upload file</label>
            <input 
                type="file"
                id="file"
                @change="handleFileUpload"
                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
            />
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
                    id: '',
                    title: '',
                    content: '',
                    file: null
                }
            },
            successMessage: ''
        };
    },
    mounted() {
        this.getPostData(this.$route.params.id);
    },
    methods: {
        handleFileUpload(event) {
            this.model.post.file = event.target.files[0];
        },
        async getPostData(id) {
            const response = await axios.get(`${url}/${id}`);
            console.log(response.data.post)
            this.model.post.title = response.data.post.title;
            this.model.post.content = response.data.post.content;
            this.model.post.id = id;
        },
        async updatePost() {
            try {
                const id = this.$route.params.id;

                let formData = new FormData();
                formData.append('title', this.model.post.title);
                formData.append('content', this.model.post.content);
                
                if (this.model.post.file) {
                    formData.append('file', this.model.post.file);
                }

                const response = await axios.post(`${url}/${id}?_method=PUT`, formData);

                this.successMessage = response.data.message;
                setTimeout(() => {
                    this.successMessage = '';
                    window.location.href = `/posts/${id}/view`;
                }, 3000);

            } catch (error) {
                console.error('Error updating post:', error);
            }
        }
    }
};
</script>
