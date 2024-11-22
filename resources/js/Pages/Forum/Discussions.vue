<template>
    <NavigationMenu />
    <div class="mt-2 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <DataTable
            title="Discussions"
            :headers="tableHeaders"
            :items="discussions"
            :showDetailsButton="false"
            :showEditButton="false"
            @view="viewDiscussion"
            @edit="editDiscussion"
            @delete="deleteDiscussion"
        />
    </div>
</template>

<script setup>
import { router, Link } from '@inertiajs/vue3';
import { route } from 'ziggy-js';
import NavigationMenu from '@/Components/NavigationMenu.vue';
import DataTable from '@/Components/DataTable.vue';
import Swal from "sweetalert2";

defineProps({
    discussions: {
        type: Array,
        required: true
    }
});

const tableHeaders = [
    { label: 'Title', key: 'title' },
    { label: 'Username', key: 'username' },
    { label: 'Topic', key: 'topic' },
];

function viewDiscussion(discussion) {
    router.get(route('discussion.show', discussion.id));
}

function editDiscussion(discussion) {
    router.get(route('discussions.edit', discussion.id));
}

function deleteDiscussion(discussion) {
    Swal.fire({
        title: 'Are you sure?',
        text: `You want to delete the discussion titled "${discussion.title}"?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#EF4444', // red-500
        cancelButtonColor: '#6B7280', // gray-500
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            router.delete(route('discussions.destroy', discussion.id), {
                onSuccess: () => {
                    Swal.fire({
                        title: 'Deleted!',
                        text: 'Discussion has been deleted.',
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
                        confirmButtonColor: '#3B82F6'
                    });
                }
            });
        }
    });
}
</script>
