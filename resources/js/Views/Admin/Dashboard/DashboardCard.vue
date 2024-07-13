<script setup>
import { defineProps } from 'vue';

const props = defineProps({
    title: String,
    value: [Number, String],
    icon: String
});
</script>

<template>
    <div class="bg-white shadow rounded-lg p-5 flex items-center">
        <div class="bg-blue-500 text-white rounded-full p-3">
            <i :class="`fas fa-${icon}`"></i>
        </div>
        <div class="ml-4">
            <h3 class="text-lg font-semibold">{{ title }}</h3>
            <p class="text-2xl font-bold">{{ value }}</p>
        </div>
    </div>
</template>

<style scoped>
/* Add any additional styles for the dashboard card */
</style>
