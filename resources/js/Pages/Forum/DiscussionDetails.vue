<template>
    <NavigationMenu />
    <div class="max-w-4xl mx-auto p-6 bg-white shadow-md rounded-lg">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold">Discussion Details</h1>
            <div class="space-x-2">
                <Link
                    :href="route('discussions.edit', discussion.slug)"
                    class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600"
                >
                    Edit
                </Link>
                <button
                    @click="goBack"
                    class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600"
                >
                    Back to Discussions
                </button>
            </div>
        </div>

        <div class="bg-gray-50 rounded-lg p-6">
            <div class="grid grid-cols-2 gap-4">
                <div class="col-span-2 md:col-span-1">
                    <div class="mb-4">
                        <h3 class="text-gray-600 text-sm font-semibold">Title</h3>
                        <p class="text-gray-900">{{ discussion.title }}</p>
                    </div>
                    <div class="mb-4">
                        <h3 class="text-gray-600 text-sm font-semibold">Username</h3>
                        <p class="text-gray-900">{{ discussion.username }}</p>
                    </div>
                </div>
                <div class="col-span-2 md:col-span-1">
                    <div class="mb-4">
                        <h3 class="text-gray-600 text-sm font-semibold">Topic</h3>
                        <p class="text-gray-900">{{ discussion.topic }}</p>
                    </div>
                    <div class="mb-4">
                        <h3 class="text-gray-600 text-sm font-semibold">Slug</h3>
                        <p class="text-gray-900">{{ discussion.slug }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import NavigationMenu from '@/Components/NavigationMenu.vue';
import { router } from '@inertiajs/vue3';
import { route } from 'ziggy-js';

const props = defineProps({
    discussion: {
        type: Object,
        required: true,
        default: () => ({
            title: '',
            username: '',
            topic: '',
            slug: '',
        }),
    },
});

function goBack() {
    router.get(route('discussions'));
}
</script>
