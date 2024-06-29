<script setup>
import {Checkbox} from "@/Components/shadcn/ui/checkbox/index.js";
import Header from "@/Components/Header.vue";
import {Switch} from "@/Components/shadcn/ui/switch/index.js";

defineProps({
    items: {
        type: Object,
        required: true
    },
    title: {
        type: String,
        required: true
    },
    icon: {
        type: Object,
        required: true
    },
    showColorBadge:{
        type: Boolean,
        default: false,
    }
})
</script>

<template>
    <div class="flex flex-col space-y-2 text-sm">
        <div class="flex w-full items-center space-x-1 pt-3">
            <component :is="icon" size="17"/>
            <div class="font-medium text-base">{{title}}</div>
        </div>
        <div class="flex flex-col space-y-3">
            <div class="flex items-center justify-between p-2 rounded-lg bg-slate-100">
                <div>All {{title}}'s</div>
                <Switch/>
            </div>
            <div v-for="item in items" class="flex items-center space-x-2 w-full pl-1">
                <div class="flex space-x-2 items-center w-9/12">
                    <Checkbox class="w-3.5 h-3.5" />
                    <div class="flex items-center space-x-1">
                        <div v-if="showColorBadge"  class="min-w-4 h-4 rounded-full border border-gray-300" :style="`background-color:` + item.value"></div>
                        <span>{{ item.name }}</span>
                    </div>
                </div>
                <div class="text-center bg-gray-100 px-3 py-0.5 rounded-lg">1712</div>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
