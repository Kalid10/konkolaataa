<template>
    <div
        v-if="error"
        class="flex flex-col h-fit w-full items-center justify-center space-y-2 rounded-md  p-2 py-3 text-center text-xs md:text-xl font-medium "
    >
        <component v-if="icon" :is="icon" class="w-4 md:w-20" />
        <CircleX v-else class="w-4 md:w-20" />
        <span> {{ error }} ! </span>
    </div>
</template>
<script setup>
import {CircleX} from "lucide-vue-next";

defineProps({
    error: {
        type: String,
        required: true,
    },
    icon: {
        type: String,
        default: null,
    },
});
</script>

<style scoped></style>
