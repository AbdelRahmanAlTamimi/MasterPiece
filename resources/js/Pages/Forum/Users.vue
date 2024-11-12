<template>
    <NavigationMenu />
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center py-4">
            <h2 class="text-2xl font-bold">Users</h2>
            <Link
                :href="route('users.create')"
                class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg"
            >
                Add New User
            </Link>
        </div>
    <DataTable
        title="Users"
        :headers="tableHeaders"
        :items="users"
        @view="viewUser"
        @edit="editUser"
        @delete="deleteUser"
    />
    </div>
</template>

<script setup>
import {router, Link} from '@inertiajs/vue3';
import {route} from 'ziggy-js';
import NavigationMenu from '@/Components/NavigationMenu.vue';
import DataTable from '@/Components/DataTable.vue';
import Swal from "sweetalert2";

defineProps({
    users: {
        type: Array,
        required: true
    }
});

const tableHeaders = [
    {label: 'ID', key: 'id'},
    {label: 'Name', key: 'name'},
    {label: 'Email', key: 'email'},
];

function viewUser(user) {
    router.get(route('users.show', user.id));
}

function editUser(user) {
    router.get(route('users.edit', user.id));
}

function deleteUser(user) {
    Swal.fire({
        title: 'Are you sure?',
        text: `You want to delete ${user.name}?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#EF4444', // red-500
        cancelButtonColor: '#6B7280', // gray-500
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            router.delete(route('users.destroy', user.id), {
                onSuccess: () => {
                    Swal.fire({
                        title: 'Deleted!',
                        text: 'User has been deleted.',
                        icon: 'success',
                        timer: 2000,
                        showConfirmButton: false
                    });
                },
                onError: () => {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Something went wrong.',
                        icon: 'error',
                        confirmButtonColor: '#3B82F6' // blue-500
                    });
                }
            });
        }
    });
}
</script>
