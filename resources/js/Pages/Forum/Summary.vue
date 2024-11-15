<template>
    <div>
        <NavigationMenu />
        <div class="p-6">
            <h1 class="text-2xl font-bold text-gray-900 mb-6">Forum Summary</h1>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4 mb-8">
                <div
                    v-for="stat in statCards"
                    :key="stat.title"
                    class="relative overflow-hidden rounded-lg bg-white p-6 shadow"
                >
                    <div class="absolute right-4 top-4">
                        <div :class="['rounded-full p-3', stat.color]">
                            <component
                                :is="stat.icon"
                                class="h-6 w-6 text-white"
                            />
                        </div>
                    </div>
                    <p class="text-sm font-medium text-gray-600">
                        {{ stat.title }}
                    </p>
                    <p class="mt-2 text-3xl font-bold text-gray-900">
                        {{ stat.value?.toLocaleString() || 0 }}
                    </p>
                </div>
            </div>

            <!-- Charts Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Solved vs Unsolved Discussions -->
                <div class="bg-white p-6 rounded-lg shadow">
                    <h2 class="text-lg font-semibold mb-4">Discussion Solutions</h2>
                    <div style="height: 300px;">
                        <Pie :data="pieChartData" :options="pieChartOptions" />
                    </div>
                </div>

                <!-- Topics by Discussions -->
                <div class="bg-white p-6 rounded-lg shadow">
                    <h2 class="text-lg font-semibold mb-4">Top Topics by Discussions</h2>
                    <div style="height: 300px;">
                        <Bar :data="barChartData" :options="barChartOptions" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { defineProps } from 'vue';
import { Users, MessageSquare, MessagesSquare, FileText } from 'lucide-vue-next';
import NavigationMenu from "@/Components/NavigationMenu.vue";

import { Chart as ChartJS, ArcElement, BarElement, CategoryScale, LinearScale, Tooltip, Legend } from 'chart.js';
import { Pie, Bar } from 'vue-chartjs';

ChartJS.register(ArcElement, BarElement, CategoryScale, LinearScale, Tooltip, Legend);

const props = defineProps({
    stats: {
        type: Object,
        required: true,
    },
});

// Stats cards data
const statCards = [
    {
        title: 'Total Users',
        value: props.stats.totalUsers,
        icon: Users,
        color: 'bg-blue-500'
    },
    {
        title: 'Total Topics',
        value: props.stats.totalTopics,
        icon: FileText,
        color: 'bg-green-500'
    },
    {
        title: 'Total Discussions',
        value: props.stats.totalDiscussions,
        icon: MessageSquare,
        color: 'bg-purple-500'
    },
    {
        title: 'Total Posts',
        value: props.stats.totalPosts,
        icon: MessagesSquare,
        color: 'bg-orange-500'
    }
];

// Prepare data for pie chart
const discussionSolutionData = [
    { name: 'Solved', value: props.stats.discussionStats.solved },
    { name: 'Unsolved', value: props.stats.discussionStats.unsolved }
];

const COLORS = ['#10B981', '#EF4444'];

// Prepare data for bar chart
const topicDiscussionData = props.stats.topicDiscussions.map(topic => ({
    name: topic.title,
    discussions: topic.discussion_count
}));

// Pie chart data
const pieChartData = {
    labels: discussionSolutionData.map(item => item.name),
    datasets: [{
        data: discussionSolutionData.map(item => item.value),
        backgroundColor: COLORS
    }]
};

const pieChartOptions = {
    responsive: true,
    maintainAspectRatio: false,
    plugins: {
        legend: {
            position: 'bottom'
        }
    }
};

// Bar chart data
const barChartData = {
    labels: topicDiscussionData.map(item => item.name),
    datasets: [{
        label: 'Discussions',
        data: topicDiscussionData.map(item => item.discussions),
        backgroundColor: '#6366F1'
    }]
};

const barChartOptions = {
    responsive: true,
    maintainAspectRatio: false,
    scales: {
        x: {
            ticks: {
                maxRotation: 90,
                minRotation: 0,
                autoSkip: false,
            },
        },
    },
    plugins: {
        legend: {
            display: false
        }
    }
};
</script>

