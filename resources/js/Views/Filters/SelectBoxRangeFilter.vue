<script setup>
import {
    Select,
    SelectContent,
    SelectGroup,
    SelectItem,
    SelectLabel,
    SelectTrigger,
    SelectValue,
} from '@/Components/shadcn/ui/select/index.js'

defineProps({
    title: {
        type: String,
        default: "Price"
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
        type: Object,
        required: true
    },
    selectBoxRangeFilter2: {
        type: Object,
        required: true
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
        <div class="flex w-full space-x-4">
            <Select>
                <SelectTrigger>
                    <SelectValue :placeholder="placeholder" />
                </SelectTrigger>
                <SelectContent>
                    <SelectGroup>
                        <SelectItem v-for="item in selectBoxRangeFilter" :value="item.value">
                            {{ item.name }}
                        </SelectItem>
                    </SelectGroup>
                </SelectContent>
            </Select>
            <Select>
                <SelectTrigger>
                    <SelectValue :placeholder="placeholder2" />
                </SelectTrigger>
                <SelectContent>
                    <SelectGroup>
                        <SelectItem v-for="item in selectBoxRangeFilter2" :value="item.value">
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
