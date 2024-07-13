<script setup>
import { defineProps } from 'vue';

const props = defineProps({
    listings: Array
});
</script>

<template>
    <div class="bg-white shadow rounded-lg p-5">
        <h2 class="text-xl font-semibold mb-4">New Listings</h2>
        <ul class="divide-y divide-gray-200">
            <li v-for="listing in listings" :key="listing.id" class="py-4 flex justify-between items-center">
                <span class="text-sm font-medium text-gray-900">{{ listing.title }}</span>
                <span class="text-sm text-gray-500">{{ listing.date }} - {{ listing.price }}</span>
            </li>
        </ul>
    </div>
</template>

<style scoped>
/* Add any additional styles for the new listings component */
</style>
