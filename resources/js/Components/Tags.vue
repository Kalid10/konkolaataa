<script setup>
defineProps({
    tag: {
        type: String,
        required: false
    }
})
</script>

<template>
    <div
        class="flex w-fit space-x-1 bg-gray-100 font-semibold border border-black px-1.5 py-0.5 mr-3 mt-1.5 capitalize rounded-md items-center text-xs">
        <div v-if="tag">
            {{ tag }}
        </div>
        <slot/>
    </div>
</template>

<style scoped>

</style>
