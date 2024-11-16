<template>
    <NavigationMenu />
    <div class="mt-2 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <DataTable
            title="Posts"
            :headers="tableHeaders"
            :items="posts"
            :showDetailsButton="true"
            :showEditButton="false"
            :showDeleteButton="true"
            @view="viewPost"
            @edit="editPost"
            @delete="deletePost"
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
    posts: {
        type: Array,
        required: true
    }
});

const tableHeaders = [
    { label: 'ID', key: 'id' },
    { label: 'Username', key: 'username' },
    { label: 'Discussion', key: 'discussion_title' },
];

function viewPost(post) {
    router.get(route('posts.show', post.id));
}

function editPost(post) {
    router.get(route('posts.edit', post.id));
}

function deletePost(post) {
    Swal.fire({
        title: 'Are you sure?',
        text: `You want to delete the post with ID "${post.id}"?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#EF4444', // red-500
        cancelButtonColor: '#6B7280', // gray-500
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            router.delete(route('posts.delete', post.id), {
                onSuccess: () => {
                    Swal.fire({
                        title: 'Deleted!',
                        text: 'Post has been deleted.',
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
