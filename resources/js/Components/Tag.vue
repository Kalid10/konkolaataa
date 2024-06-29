<script setup>
defineEmits(['click'])
defineProps({
    value: {
        type: String,
        required: true
    },
})
</script>

<template>
<div class="min-w-fit w-fit h-fit px-4 font-semibold cursor-pointer hover:scale-105 py-1 bg-gray-100 text-sm uppercase rounded-xl" @click="$emit('click')">
    {{value}}
</div>
</template>

<style scoped>

</style>
