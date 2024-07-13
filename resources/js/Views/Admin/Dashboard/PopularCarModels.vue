<script setup>
import { defineProps } from 'vue';

const props = defineProps({
    models: Array
});
</script>

<template>
    <div class="bg-white shadow rounded-lg p-5">
        <h2 class="text-xl font-semibold mb-4">Popular Car Models</h2>
        <ul class="divide-y divide-gray-200">
            <li v-for="model in models" :key="model.id" class="py-4 flex justify-between items-center">
                <span class="text-sm font-medium text-gray-900">{{ model.model }}</span>
                <span class="text-sm text-gray-500">{{ model.searches }} searches</span>
            </li>
        </ul>
    </div>
</template>

<style scoped>
/* Add any additional styles for the popular car models component */
</style>
