<script setup>
import ForumLayout from '@/Layouts/ForumLayout.vue';
import Select from "@/Components/Select.vue";
import { Head } from '@inertiajs/vue3';
import InputLabel from "@/Components/InputLabel.vue";

</script>

<template>
    <Head title="Forum" />

    <ForumLayout>

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">

                <InputLabel for="topic" value="Topic" class="sr-only" />



                <Select>
                    <option value="">All Topics</option>
                    <option :value="topic.slug" v-for="topic in $page.props.topics" :key="topic.id">
                                {{topic.name}}
                    </option>

                </Select>
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
