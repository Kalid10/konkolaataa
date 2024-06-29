<script setup>
defineProps({
    title: {
        type: String,
        required: true
    },
    inputPlaceholder: {
        type: String,
        default: "From"
    },
    inputPlaceholder2: {
        type: String,
        default: "To"
    },
    icon: {
        type: Object,
        required: true
    }
})
</script>

<template>
    <div class="flex flex-col space-y-2 py-4 w-full">
        <div class="flex w-full items-center space-x-1">
            <component :is="icon" size="17"/>
            <div class="font-medium text-base">{{title}}</div>
        </div>
        <div class="flex w-full space-x-2">
            <Input :placeholder="inputPlaceholder" value="0" class="text-sm md:w-32 h-8 border border-gray-900 rounded-sm px-2"/>
            <span>-</span>
            <Input :placeholder="inputPlaceholder2" value="2000000" class="border border-gray-900 rounded-sm px-2 text-sm md:w-32 h-8"/>
        </div>
    </div>
</template>

<style scoped>

</style>
