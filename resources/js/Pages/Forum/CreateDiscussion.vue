<template>
    <NavigationMenu />
    <div class="max-w-4xl mx-auto p-6 bg-white shadow-md rounded-lg">
        <h1 class="text-3xl font-bold mb-4">Create New Discussion</h1>
        <form @submit.prevent="createDiscussion">
            <div class="mb-4">
                <label for="title" class="block text-gray-700 font-bold mb-2">Title:</label>
                <input
                    type="text"
                    id="title"
                    v-model="form.title"
                    class="w-full p-2 border border-gray-300 rounded"
                    required
                />
                <div v-if="form.errors.title" class="text-red-500 text-sm mt-1">
                    {{ form.errors.title }}
                </div>
            </div>

            <div class="mb-4">
                <label for="topic" class="block text-gray-700 font-bold mb-2">Topic:</label>
                <select
                    id="topic"
                    v-model="form.topic_id"
                    class="w-full p-2 border border-gray-300 rounded"
                    required
                >
                    <option value="">Select a topic</option>
                    <option v-for="topic in topics" :key="topic.id" :value="topic.id">
                        {{ topic.title }}
                    </option>
                </select>
                <div v-if="form.errors.topic_id" class="text-red-500 text-sm mt-1">
                    {{ form.errors.topic_id }}
                </div>
            </div>

            <div class="mb-4">
                <label for="user" class="block text-gray-700 font-bold mb-2">Discussion Creator:</label>
                <select
                    id="user"
                    v-model="form.user_id"
                    class="w-full p-2 border border-gray-300 rounded"
                    required
                >
                    <option value="">Select a user</option>
                    <option v-for="user in users" :key="user.id" :value="user.id">
                        {{ user.name }}
                    </option>
                </select>
                <div v-if="form.errors.user_id" class="text-red-500 text-sm mt-1">
                    {{ form.errors.user_id }}
                </div>
            </div>

            <div class="mt-6">
                <button
                    type="submit"
                    class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600"
                    :disabled="form.processing"
                >
                    Create Discussion
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

const props = defineProps({
    topics: {
        type: Array,
        required: true
    },
    users: {
        type: Array,
        required: true
    }
});

const form = useForm({
    title: '',
    topic_id: '',
    user_id: ''
});

function createDiscussion() {
    form.post(route('discussion.store'), {
        onSuccess: () => {
            router.get(route('discussions'));
        },
    });
}

function goBack() {
    router.get(route('discussions'));
}
</script>
