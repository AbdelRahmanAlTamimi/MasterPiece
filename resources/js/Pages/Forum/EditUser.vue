<template>
    <NavigationMenu />
    <div class="max-w-4xl mx-auto p-6 bg-white shadow-md rounded-lg">
        <h1 class="text-3xl font-bold mb-4">Edit User</h1>
        <form @submit.prevent="updateUser">
            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-bold mb-2">Name:</label>
                <input
                    type="text"
                    id="name"
                    v-model="form.name"
                    class="w-full p-2 border border-gray-300 rounded"
                    required
                />
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
            </div>
            <div class="mb-4">
                <label for="role" class="block text-gray-700 font-bold mb-2">Role:</label>
                <select
                    id="role"
                    v-model="form.role"
                    class="w-full p-2 border border-gray-300 rounded"
                >
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                </select>
            </div>
            <div class="mt-6">
                <button
                    type="submit"
                    class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600"
                >
                    Update
                </button>
                <button
                    @click="goBack"
                    type="button"
                    class="ml-2 bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600"
                >
                    Back to Users
                </button>
            </div>
        </form>
    </div>
</template>

<script setup>
import { useForm, router } from '@inertiajs/vue3';
import NavigationMenu from '@/Components/NavigationMenu.vue';
import { defineProps } from 'vue';

const props = defineProps({
    user: {
        type: Object,
        required: true,
    },
});

const form = useForm({
    name: props.user.name,
    email: props.user.email,
    role: props.user.role,
});

function updateUser() {
    form.put(`/users/${props.user.id}`);
}

function goBack() {
    router.get(route('users.index'));
}
</script>

