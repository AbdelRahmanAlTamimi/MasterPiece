<template>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900 flex items-start space-x-3">

            <div class="w-7 flex-shrink-0">
                <img :src="post.user?.avatar_url" class="w-7 h-7 rounded-full" v-if="post.user">
            </div>

            <div class="w-full">
                    <div>{{ post.user?.username || '[user deleted]' }}</div>
                    <div class="text-sm text-gray-500"> Posted 
                        <time :datetime="post.created_at.datetime"
                              :title="post.created_at.datetime">
                              {{ post.created_at.human }}
                        </time>
                    </div>
                    <div class="mt-3">
                        {{ post.body }}
                    </div>
            </div>

    </div>
</template>

<script setup>
    import {Link} from "@inertiajs/vue3";

    defineProps({
        post: Object
    })

</script>
