
<template>
    <NavigationMenu />
        <div>
            <h1>Summary</h1>
            <ul>
                <li>Users: {{ userCount }}</li>
                <li>Topics: {{ topicCount }}</li>
                <li>Discussions: {{ discussionCount }}</li>
                <li>Posts: {{ postCount }}</li>
            </ul>
        </div>

</template>

<script setup>
import NavigationMenu from "@/Components/NavigationMenu.vue";
defineProps(['userCount', 'topicCount', 'discussionCount', 'postCount']);
</script>
