
<template>
  <Head :title="post.id ? 'Edit Post' : 'Create Post'" />

  <AuthenticatedLayout>

        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ post.id ? 'Edit' : 'Create' }} Post</h2>
        </template>

    <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <form @submit.prevent="submitForm" method="post">

        <label class="block">Title
            <input type="text" name="title" v-model="form.title">
        </label>
        
        <div class=" text-rose-700" v-if="form.errors.title">{{ form.errors.title }}</div>

        <label class="block">Post Date
            <input type="date" name="post_date" v-model="form.post_date">
        </label>
        <div class="text-rose-700" v-if="form.errors.post_date">{{ form.errors.post_date }}</div>

        <label class="block">Content
            <textarea type="text" name="content" v-model="form.content"></textarea>
        </label>
        <div class="text-rose-700" v-if="form.errors.content">{{ form.errors.content }}</div>

        <button type="submit">Save</button>
    </form>
    </div>
    </div>
  </AuthenticatedLayout>

</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, router, useForm } from '@inertiajs/vue3';

import { ref } from "vue";


const { post } = defineProps({ post: Object, errors: Object })

// const post = ref({
//     title: null,
//     post_date: null,
//     content: null,
// })

const form = useForm(post);

const submitForm = () => {
    if(post.id){
        // router.put(`/posts/${post.id}`, post.value)
        form.put(`/posts/${post.id}`);
    }else{
        form.post('/posts')
    }
}

</script>