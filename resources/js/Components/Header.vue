<script setup>
defineProps({
    title: {
        type: String,
        required: false
    },
    subtitle: {
        type: String,
        required: false
    },

});
</script>

<template>
    <label class="flex flex-col capitalize space-y-0.5">
        <span class="font-semibold text-2xl md:text-4xl" v-if="title">{{ title }}</span>
        <span v-if="subtitle" class="block text-sm md:text-base font-light text-gray-700">{{ subtitle }}</span>
        <span v-else><slot /></span>
    </label>
</template>
