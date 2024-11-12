<template>
    <NavigationMenu />
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center py-4">
            <h2 class="text-2xl font-bold">Topics</h2>
            <Link
                :href="route('topics.create')"
                class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg"
            >
                Add New Topic
            </Link>
        </div>
        <DataTable
            title="Topics"
            :headers="tableHeaders"
            :items="topics"
            @edit="editTopic"
            @delete="deleteTopic"
        />
    </div>
</template>

<script setup>
import {router, Link} from '@inertiajs/vue3';
import {route} from 'ziggy-js';
import NavigationMenu from '@/Components/NavigationMenu.vue';
import DataTable from '@/Components/DataTable.vue';
import Swal from 'sweetalert2';

defineProps({
    topics: {
        type: Array,
        required: true
    }
});

const tableHeaders = [
    {label: 'ID', key: 'id'},
    {label: 'Title', key: 'title'},
    {label: 'Slug', key: 'slug'},
];



function editTopic(topic) {
    router.get(route('topics.edit', topic.id));
}

function deleteTopic(topic) {
    Swal.fire({
        title: 'Are you sure?',
        text: `You want to delete "${topic.title}"?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#EF4444', // red-500
        cancelButtonColor: '#6B7280', // gray-500
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            router.delete(route('topics.destroy', topic.id), {
                onSuccess: () => {
                    Swal.fire({
                        title: 'Deleted!',
                        text: 'Topic has been deleted.',
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
