
<template>
    <ForumLayout>
        <div>
            <h1>Summary</h1>
            <ul>
                <li>Users: {{ userCount }}</li>
                <li>Topics: {{ topicCount }}</li>
                <li>Discussions: {{ discussionCount }}</li>
                <li>Posts: {{ postCount }}</li>
            </ul>
        </div>
    </ForumLayout>
</template>

<script setup>
import ForumLayout from '@/Layouts/ForumLayout.vue';

defineProps(['userCount', 'topicCount', 'discussionCount', 'postCount']);
</script>
