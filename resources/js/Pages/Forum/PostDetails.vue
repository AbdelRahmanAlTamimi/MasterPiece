<template>
    <NavigationMenu />
    <div class="max-w-4xl mx-auto p-6 bg-white shadow-md rounded-lg">
        <!-- Flash Message -->
        <div v-if="$page.props.flash.success"
             class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded relative"
             role="alert"
        >
            <span class="block sm:inline">{{ $page.props.flash.success }}</span>
            <button
                @click="$page.props.flash.success = null"
                class="absolute top-0 bottom-0 right-0 px-4 py-3"
            >
                <span class="sr-only">Close</span>
                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold">Post Details</h1>
            <div class="space-x-2">

                <button
                    @click="goBack"
                    class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600"
                >
                    Back to Posts
                </button>
            </div>
        </div>

        <!-- Post Content -->
        <div class="bg-gray-50 rounded-lg p-6">
            <div class="grid grid-cols-2 gap-4">
                <div class="col-span-2 md:col-span-1">
                    <div class="mb-4">
                        <h3 class="text-gray-600 text-sm font-semibold">Discussion Title</h3>
                        <p class="text-gray-900">
                            <span v-if="post.discussionTitle">{{ post.discussionTitle }}</span>
                            <span v-else class="text-red-500 italic">Deleted Discussion</span>
                        </p>
                    </div>
                    <div class="mb-4">
                        <h3 class="text-gray-600 text-sm font-semibold">Author</h3>
                        <p class="text-gray-900">{{ post.username }}</p>
                    </div>
                </div>
                <div class="col-span-2 md:col-span-1">
                    <div class="mb-4">
                        <h3 class="text-gray-600 text-sm font-semibold">Posted On</h3>
                        <p class="text-gray-900">{{ post.createdAt }}</p>
                    </div>
                    <div class="mb-4">
                        <h3 class="text-gray-600 text-sm font-semibold">Post ID</h3>
                        <p class="text-gray-900">#{{ post.id }}</p>
                    </div>
                </div>
                <div class="col-span-2">
                    <div class="mb-4">
                        <h3 class="text-gray-600 text-sm font-semibold">Content</h3>
                        <p class="text-gray-900 whitespace-pre-wrap">{{ post.body }}</p>
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
    post: {
        type: Object,
        required: true,
        default: () => ({
            id: '',
            body: '',
            createdAt: '',
            username: '',
            discussionTitle: '',
        }),
    },
});

function goBack() {
    router.get(route('posts.index'));
}
</script>
