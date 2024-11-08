<template>
    <NavigationMenu />
    <DataTable
        title="Topics"
        :headers="tableHeaders"
        :items="topics"
        @view="viewTopic"
        @edit="editTopic"
        @delete="deleteTopic"
    />
</template>

<script setup>
import NavigationMenu from '@/Components/NavigationMenu.vue';
import DataTable from '@/Components/DataTable.vue';

defineProps(['topics']);

const tableHeaders = [
    { label: 'ID', key: 'id' },
    { label: 'Title', key: 'title' },
    { label: 'Description', key: 'description' },
];

function viewTopic(topic) {
    // Redirect to topic details page
    $inertia.get(route('topics.show', topic.id));
}

function editTopic(topic) {
    // Redirect to topic edit page
    $inertia.get(route('topics.edit', topic.id));
}

function deleteTopic(topic) {
    // Perform delete action
    if (confirm(`Are you sure you want to delete the topic "${topic.title}"?`)) {
        $inertia.delete(route('topics.destroy', topic.id));
    }
}
</script>
