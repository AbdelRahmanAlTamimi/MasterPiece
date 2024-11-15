<template>
    <NavigationMenu />
    <div class="max-w-4xl mx-auto p-6 bg-white shadow-md rounded-lg">
        <h1 class="text-3xl font-bold mb-4">Create New User</h1>
        <form @submit.prevent="createUser">
            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-bold mb-2">Name:</label>
                <input
                    type="text"
                    id="name"
                    v-model="form.name"
                    class="w-full p-2 border border-gray-300 rounded"
                    required
                />
                <div v-if="form.errors.name" class="text-red-500 text-sm mt-1">
                    {{ form.errors.name }}
                </div>
            </div>

            <div class="mb-4">
                <label for="username" class="block text-gray-700 font-bold mb-2">Username:</label>
                <input
                    type="text"
                    id="username"
                    v-model="form.username"
                    class="w-full p-2 border border-gray-300 rounded"
                    required
                />
                <div v-if="form.errors.username" class="text-red-500 text-sm mt-1">
                    {{ form.errors.username }}
                </div>
            </div>

            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-bold mb-2">Email:</label>
                <input
                    type="email"
                    id="email"
                    v-model="form.email"
                    class="w-full p-2 border border-gray-300 rounded"
                    required
                />
                <div v-if="form.errors.email" class="text-red-500 text-sm mt-1">
                    {{ form.errors.email }}
                </div>
            </div>

            <div class="mb-4">
                <label for="password" class="block text-gray-700 font-bold mb-2">Password:</label>
                <input
                    type="password"
                    id="password"
                    v-model="form.password"
                    class="w-full p-2 border border-gray-300 rounded"
                    required
                />
                <div v-if="form.errors.password" class="text-red-500 text-sm mt-1">
                    {{ form.errors.password }}
                </div>
            </div>

            <div class="mb-4">
                <label for="role" class="block text-gray-700 font-bold mb-2">Role:</label>
                <select
                    id="role"
                    v-model="form.role"
                    class="w-full p-2 border border-gray-300 rounded"
                    required
                >
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                </select>
                <div v-if="form.errors.role" class="text-red-500 text-sm mt-1">
                    {{ form.errors.role }}
                </div>
            </div>

            <div class="mt-6">
                <button
                    type="submit"
                    class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600"
                    :disabled="form.processing"
                >
                    Create User
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
    name: '',
    username: '',
    email: '',
    password: '',
    role: 'user',
});

function createUser() {
    form.post(route('users.store'), {
        onSuccess: () => {
            router.get(route('users.index'));
        },
    });
}

function goBack() {
    router.get(route('users.index'));
}
</script>
