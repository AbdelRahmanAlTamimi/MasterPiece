<template>
    <NavigationMenu />
    <div class="max-w-4xl mx-auto p-6 bg-white shadow-md rounded-lg">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold">User Details</h1>
            <div class="space-x-2">
                <Link
                    :href="route('users.edit', user.id)"
                    class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600"
                >
                    Edit
                </Link>
                <button
                    @click="goBack"
                    class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600"
                >
                    Back to Users
                </button>
            </div>
        </div>

        <div class="bg-gray-50 rounded-lg p-6">
            <div class="grid grid-cols-2 gap-4">
                <div class="col-span-2 md:col-span-1">
                    <div class="mb-4">
                        <h3 class="text-gray-600 text-sm font-semibold">ID</h3>
                        <p class="text-gray-900">{{ user.id }}</p>
                    </div>
                    <div class="mb-4">
                        <h3 class="text-gray-600 text-sm font-semibold">Name</h3>
                        <p class="text-gray-900">{{ user.name }}</p>
                    </div>
                    <div class="mb-4">
                        <h3 class="text-gray-600 text-sm font-semibold">Username</h3>
                        <p class="text-gray-900">{{ user.username }}</p>
                    </div>
                </div>
                <div class="col-span-2 md:col-span-1">
                    <div class="mb-4">
                        <h3 class="text-gray-600 text-sm font-semibold">Email</h3>
                        <p class="text-gray-900">{{ user.email }}</p>
                    </div>
                    <div class="mb-4">
                        <h3 class="text-gray-600 text-sm font-semibold">Role</h3>
                        <span
                            :class="{
                                'px-3 py-1 rounded-full text-sm font-semibold': true,
                                'bg-blue-100 text-blue-800': user.role === 'admin',
                                'bg-green-100 text-green-800': user.role === 'user'
                            }"
                        >
                            {{ user.role.charAt(0).toUpperCase() + user.role.slice(1) }}
                        </span>
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
    user: {
        type: Object,
        required: true,
        default: () => ({
            id: '',
            name: '',
            username: '',
            email: '',
            role: '',
        }),
    },
});

function goBack() {
    router.get(route('users.index'));
}
</script>
