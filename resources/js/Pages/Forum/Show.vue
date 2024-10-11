<script setup>
import ForumLayout from '@/Layouts/ForumLayout.vue';

import { Head } from '@inertiajs/vue3';

import Pagination from "@/Components/Pagination.vue";


defineProps({
    discussion: Object
})

</script>

<template>
    <Head :title="discussion.title" />

    <ForumLayout>

        <div class="space-y-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

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
                </div>
            </div>



        </div>



        <template #side>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    hi
                </div>
            </div>

        </template>


    </ForumLayout>
</template>
