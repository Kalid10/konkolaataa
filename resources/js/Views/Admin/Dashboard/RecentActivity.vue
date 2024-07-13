<script setup>
import { defineProps } from 'vue';

const props = defineProps({
    activities: Array
});
</script>

<template>
    <div class="divide-y divide-gray-200">
        <div v-for="activity in activities" :key="activity.id" class="py-4 flex">
            <div class="ml-3">
                <p class="text-sm font-medium text-gray-900">{{ activity.description }}</p>
                <p class="text-sm text-gray-500">{{ activity.time }}</p>
            </div>
        </div>
    </div>
</template>

<style scoped>
/* Add any additional styles for the recent activity component */
</style>
