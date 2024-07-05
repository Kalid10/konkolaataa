<script setup>
import {
    Select,
    SelectContent,
    SelectGroup,
    SelectItem,
    SelectTrigger,
    SelectValue,
} from '@/Components/shadcn/ui/select/index.js'
import { ref, watch } from 'vue';

const props = defineProps({
    title: {
        type: String,
        required: true
    },
    placeholder: {
        type: String,
        default: "From"
    },
    placeholder2: {
        type: String,
        default: "To"
    },
    selectBoxRangeFilter: {
        type: Array,
        required: true
    },
    selectBoxRangeFilter2: {
        type: Array,
        required: true
    },
    icon: {
        type: Object,
        required: true
    }
});

const emit = defineEmits(['update:range']);

const selectedFrom = ref(null);
const selectedTo = ref(null);

watch([selectedFrom, selectedTo], () => {
    emit('update:range', {from: selectedFrom.value, to: selectedTo.value});
});
</script>

<template>
    <div class="flex flex-col space-y-2 py-4 w-full">
        <div class="flex w-full items-center space-x-1">
            <component :is="icon" size="17"/>
            <div class="font-medium text-base">{{ title }}</div>
        </div>
        <div class="flex w-full space-x-4">
            <Select v-model="selectedFrom">
                <SelectTrigger>
                    <SelectValue :placeholder="placeholder"/>
                </SelectTrigger>
                <SelectContent>
                    <SelectGroup>
                        <SelectItem v-for="item in selectBoxRangeFilter" :key="item.value" :value="item.value">
                            {{ item.name }}
                        </SelectItem>
                    </SelectGroup>
                </SelectContent>
            </Select>
            <Select v-model="selectedTo">
                <SelectTrigger>
                    <SelectValue :placeholder="placeholder2"/>
                </SelectTrigger>
                <SelectContent>
                    <SelectGroup>
                        <SelectItem v-for="item in selectBoxRangeFilter2" :key="item.value" :value="item.value">
                            {{ item.name }}
                        </SelectItem>
                    </SelectGroup>
                </SelectContent>
            </Select>
        </div>
    </div>
</template>

<style scoped>
</style>
