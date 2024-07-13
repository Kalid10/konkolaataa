<script setup>
import { defineProps } from 'vue';

const props = defineProps({
    approvals: Array
});
</script>

<template>
    <div class="bg-white shadow rounded-lg p-5">
        <h2 class="text-xl font-semibold mb-4">Pending Approvals</h2>
        <ul class="divide-y divide-gray-200">
            <li v-for="approval in approvals" :key="approval.id" class="py-4 flex justify-between items-center">
                <span class="text-sm font-medium text-gray-900">{{ approval.type }}: {{ approval.detail }}</span>
                <span class="text-sm text-gray-500">{{ approval.date }}</span>
            </li>
        </ul>
    </div>
</template>

<style scoped>
/* Add any additional styles for the pending approvals component */
</style>
