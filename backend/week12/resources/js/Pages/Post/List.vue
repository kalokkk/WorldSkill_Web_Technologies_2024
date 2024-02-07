<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Pagination from "@/Components/Pagination.vue";
import { Head, Link, router } from "@inertiajs/vue3";
import { ref } from "vue";

const { filters } = defineProps({ posts: Array, filters: Object });

const form = ref({
  search: filters.search,
  post_date: filters.post_date,
});

const applyFilter = () => {
  // console.log(form.value.search);
  router.get("/posts", form.value, { preserveState: true });
};
</script>

<template>
  <Head title="Posts" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Posts</h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex items-center justify-between mb-6">
          <form @submit.prevent="applyFilter">
            <div class="flex items-center mt-6">
              <label class="block text-gray-700">Author Name:</label>
              <input type="search" name="search" v-model="form.search" />

              <label class="block text-gray-700">Date:</label>
              <input type="date" name="post_date" v-model="form.post_date" />

              <button type="submit">Search</button>
            </div>
          </form>
          <Link class="btn-indigo" href="/posts/new">
            <span>Create</span>
            <span class="hidden md:inline">&nbsp;Post</span>
          </Link>
        </div>
      </div>
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <table width="100%">
          <tr>
            <th class="border-b-2">&nbsp;</th>
            <th class="border-b-2">User</th>
            <th class="border-b-2">Title</th>
            <th class="border-b-2">Content</th>
          </tr>
          <tr v-for="(post, index) in posts.data" :key="post.id">
            <td>{{ index }}</td>
            <td>
              <Link :href="`/posts/${post.id}`">{{ post.user.name }}</Link>
            </td>
            <td>{{ post.title }}</td>
            <td>{{ post.content }}</td>
          </tr>
        </table>

        <pagination :links="posts.links"></pagination>

      </div>
    </div>
  </AuthenticatedLayout>
</template>
