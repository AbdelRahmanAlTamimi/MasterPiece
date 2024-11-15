<template>
    <NavigationMenu />
    <div class="max-w-4xl mx-auto p-6 bg-white shadow-md rounded-lg">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold">Edit Discussion</h1>
            <button
                @click="goBack"
                class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600"
            >
                Back to Discussions
            </button>
        </div>

        <form @submit.prevent="submit" class="bg-gray-50 rounded-lg p-6">
            <div class="grid grid-cols-1 gap-6">
                <!-- Title Input -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">
                        Title
                    </label>
                    <input
                        id="title"
                        v-model="form.title"
                        type="text"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                        :class="{ 'border-red-500': form.errors.title }"
                    />
                    <div v-if="form.errors.title" class="text-red-500 text-sm mt-1">
                        {{ form.errors.title }}
                    </div>
                </div>

                <!-- Topic Selection -->
                <div>
                    <label for="topic" class="block text-sm font-medium text-gray-700">
                        Topic
                    </label>
                    <select
                        id="topic"
                        v-model="form.topic_id"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                        :class="{ 'border-red-500': form.errors.topic_id }"
                    >
                        <option v-for="topic in topics" :key="topic.id" :value="topic.id">
                            {{ topic.title }}
                        </option>
                    </select>
                    <div v-if="form.errors.topic_id" class="text-red-500 text-sm mt-1">
                        {{ form.errors.topic_id }}
                    </div>
                </div>

                <!-- User Selection -->
                <div>
                    <label for="user" class="block text-sm font-medium text-gray-700">
                        Discussion Creator
                    </label>
                    <select
                        id="user"
                        v-model="form.user_id"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                        :class="{ 'border-red-500': form.errors.user_id }"
                    >
                        <option v-for="user in users" :key="user.id" :value="user.id">
                            {{ user.name }}
                        </option>
                    </select>
                    <div v-if="form.errors.user_id" class="text-red-500 text-sm mt-1">
                        {{ form.errors.user_id }}
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end space-x-2">
                    <button
                        type="button"
                        @click="goBack"
                        class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                    >
                        Cancel
                    </button>
                    <button
                        type="submit"
                        :disabled="form.processing"
                        class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                        :class="{ 'opacity-75 cursor-not-allowed': form.processing }"
                    >
                        Save Changes
                    </button>
                </div>
            </div>
        </form>
    </div>
</template>

<script setup>
import {useForm} from '@inertiajs/vue3';
import {Link} from '@inertiajs/vue3';
import NavigationMenu from '@/Components/NavigationMenu.vue';
import {router} from '@inertiajs/vue3';
import {route} from 'ziggy-js';

const props = defineProps({
    discussion: {
        type: Object,
        required: true,
    },
    topics: {
        type: Array,
        required: true,
    },
    users: {
        type: Array,
        required: true,
    }
});

const form = useForm({
    title: props.discussion.title,
    topic_id: props.discussion.topic_id,
    user_id: props.discussion.user_id
});

function submit() {
    form.put(route('discussions.update', props.discussion.id), {
        onSuccess: () => {
            // Optional: Add success notification here
        },
    });
}

function goBack() {
    router.get(route('discussions.index'));
}
</script>
