<script setup>

import {
    Select,
    SelectContent,
    SelectGroup,
    SelectItem,
    SelectTrigger,
    SelectValue
} from "@/Components/shadcn/ui/select/index.js";
import InputLabel from "@/Components/InputLabel.vue";
import {useForm} from "@inertiajs/vue3";
import {Input} from "@/Components/shadcn/ui/input/index.js";

const sellerTypes = [
    {name: 'Broker', value: 'broker'},
    {name: 'Owner', value: 'private'},
];

const form = useForm({
    sellerType: null,
    percentage: 2,
});
</script>

<template>
    <div class="flex flex-col space-y-4">
        <div class="flex flex-col space-y-2">
            <InputLabel>Who are you?</InputLabel>
            <Select v-model="form.sellerType">
                <SelectTrigger>
                    <SelectValue placeholder="Select Seller Type" />
                </SelectTrigger>
                <SelectContent>
                    <SelectGroup>
                        <SelectItem v-for="item in sellerTypes" :value="item.value">
                            {{ item.name }}
                        </SelectItem>
                    </SelectGroup>
                </SelectContent>
            </Select>
        </div>

        <div v-if="form.sellerType === 'broker'" class="flex flex-col space-y-2">
            <InputLabel>Percentage</InputLabel>
            <Input  v-model="form.percentage" placeholder="2%"/>
        </div>
    </div>
</template>

<style scoped>

</style>
