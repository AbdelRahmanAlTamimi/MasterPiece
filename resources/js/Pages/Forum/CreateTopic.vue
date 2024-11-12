<template>
    <NavigationMenu />
    <div class="max-w-4xl mx-auto p-6 bg-white shadow-md rounded-lg">
        <h1 class="text-3xl font-bold mb-4">Create New Topic</h1>
        <form @submit.prevent="createTopic">
            <div class="mb-4">
                <label for="title" class="block text-gray-700 font-bold mb-2">Title:</label>
                <input
                    type="text"
                    id="title"
                    v-model="form.title"
                    @input="generateSlug"
                    class="w-full p-2 border border-gray-300 rounded"
                    required
                />
                <div v-if="form.errors.title" class="text-red-500 text-sm mt-1">
                    {{ form.errors.title }}
                </div>
            </div>

            <div class="mb-4">
                <label for="slug" class="block text-gray-700 font-bold mb-2">Slug:</label>
                <input
                    type="text"
                    id="slug"
                    v-model="form.slug"
                    class="w-full p-2 border border-gray-300 rounded bg-gray-50"
                    readonly
                />
                <div v-if="form.errors.slug" class="text-red-500 text-sm mt-1">
                    {{ form.errors.slug }}
                </div>
            </div>

            <div class="mt-6">
                <button
                    type="submit"
                    class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600"
                    :disabled="form.processing"
                >
                    Create Topic
                </button>
                <button
                    @click="goBack"
                    type="button"
                    class="ml-2 bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600"
                >
                    Cancel
                </button>
            </div>
        </form>
    </div>
</template>

<script setup>
import { useForm, router } from '@inertiajs/vue3';
import NavigationMenu from '@/Components/NavigationMenu.vue';
import { route } from 'ziggy-js';

const form = useForm({
    title: '',
    slug: '',
});

function generateSlug() {
    form.slug = form.title
        .toLowerCase()
        .replace(/[^\w\s-]/g, '') // Remove special characters
        .replace(/\s+/g, '-') // Replace spaces with -
        .replace(/-+/g, '-') // Replace multiple - with single -
        .trim(); // Trim - from start and end
}

function createTopic() {
    form.post(route('topics.store'), {
        onSuccess: () => {
            router.get(route('topics'));
        },
    });
}

function goBack() {
    router.get(route('topics'));
}
</script>
