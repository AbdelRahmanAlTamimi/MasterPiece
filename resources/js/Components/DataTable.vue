<template>
    <div>
        <h1 class="text-2xl font-bold mb-4">{{ title }}</h1>
        <table class="min-w-full bg-white">
            <thead>
            <tr>
                <!-- Table Headers -->
                <th
                    v-for="header in headers"
                    :key="header.key"
                    class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-sm font-medium text-gray-600 uppercase tracking-wider"
                >
                    {{ header.label }}
                </th>
                <!-- Actions Header -->
                <th
                    v-if="showActions"
                    class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-sm font-medium text-gray-600 uppercase tracking-wider"
                >
                    Actions
                </th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="item in items" :key="item.id">
                <!-- Table Data -->
                <td
                    v-for="header in headers"
                    :key="header.key"
                    class="py-2 px-4 border-b border-gray-200"
                >
                    {{ item[header.key] }}
                </td>
                <!-- Actions Column -->
                <td v-if="showActions" class="py-2 px-4 border-b border-gray-200">
                    <button
                        v-if="showDetailsButton"
                        @click="viewDetails(item)"
                        class="text-blue-500 hover:underline mr-2"
                    >
                        Details
                    </button>
                    <button
                        v-if="showEditButton"
                        @click="editItem(item)"
                        class="text-green-500 hover:underline mr-2"
                    >
                        Edit
                    </button>
                    <button
                        v-if="showDeleteButton"
                        @click="deleteItem(item)"
                        class="text-red-500 hover:underline"
                    >
                        Delete
                    </button>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script setup>
import { defineEmits, defineProps, computed } from 'vue';

const props = defineProps({
    title: {
        type: String,
        default: '',
    },
    headers: {
        type: Array,
        required: true,
    },
    items: {
        type: Array,
        required: true,
    },
    showDetailsButton: {
        type: Boolean,
        default: true,
    },
    showEditButton: {
        type: Boolean,
        default: true,
    },
    showDeleteButton: {
        type: Boolean,
        default: true,
    },
});

const emit = defineEmits(['view', 'edit', 'delete']);

function viewDetails(item) {
    emit('view', item);
}

function editItem(item) {
    emit('edit', item);
}

function deleteItem(item) {
    emit('delete', item);
}

const showActions = computed(
    () => props.showDetailsButton || props.showEditButton || props.showDeleteButton
);
</script>
