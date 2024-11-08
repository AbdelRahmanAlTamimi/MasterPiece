<template>
    <NavigationMenu />
    <DataTable
        title="Users"
        :headers="tableHeaders"
        :items="users"
        @view="viewUser"
        @edit="editUser"
        @delete="deleteUser"
    />
</template>

<script setup>
import {Inertia} from '@inertiajs/inertia'; // Import Inertia
// import route from 'ziggy-js';
import NavigationMenu from '@/Components/NavigationMenu.vue';
import DataTable from '@/Components/DataTable.vue';
import {defineProps} from 'vue';

defineProps(['users']);

const tableHeaders = [
    {label: 'ID', key: 'id'},
    {label: 'Name', key: 'name'},
    {label: 'Email', key: 'email'},
];

function viewUser(user) {
    Inertia.get(route('users.show', user.id));
}

function editUser(user) {
    Inertia.get(route('users.edit', user.id));
}

function deleteUser(user) {
    if (confirm(`Are you sure you want to delete ${user.name}?`)) {
        Inertia.delete(route('users.destroy', user.id));
    }
}
</script>
