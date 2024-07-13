<script setup>
import { defineProps } from 'vue';

const props = defineProps({
    users: Array
});
</script>

<template>
    <div class="bg-white shadow rounded-lg p-5">
        <h2 class="text-xl font-semibold mb-4">Top Performing Users</h2>
        <ul class="divide-y divide-gray-200">
            <li v-for="user in users" :key="user.id" class="py-4 flex justify-between items-center">
                <span class="text-sm font-medium text-gray-900">{{ user.name }}</span>
                <span class="text-sm text-gray-500">{{ user.sales }} Sales</span>
            </li>
        </ul>
    </div>
</template>

<style scoped>
/* Add any additional styles for the top performing users */
</style>
