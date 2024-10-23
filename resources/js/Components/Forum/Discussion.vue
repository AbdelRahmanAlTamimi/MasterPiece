<template>

    <Link :href="route('discussion.show',discussion) " class="block bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 flex items-center space-x-6">
            <div class="flex-grow">
                <div class="flex items-center space-x-3">
                    <span class="inline-flex items-center
                     rounded-lg bg-gray-100
                      px-3 py-0.5
                      text-gray-600 text-sm">
                    {{discussion.topic.title}}
                    </span>
                    <h1 class="text-lg font-medium">
                        <template v-if="discussion.is_pinned">
                            📌
                        </template>
                        {{discussion.title}}

                    </h1>
                </div>
                <div class="text-sm text-gray-500 mt-3 line-clamp-1">
                    {{ discussion.post.body_preview }}
                </div>
            </div>
            <div>
                avatar
            </div>
        </div>
    </Link>
</template>

<script setup>

import { Link } from '@inertiajs/vue3'
defineProps({

    discussion: Object
})

</script>
