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
import {useForm, usePage} from "@inertiajs/vue3";
import {Input} from "@/Components/shadcn/ui/input/index.js";
import {watch} from "vue";
import {Switch} from "@/Components/shadcn/ui/switch/index.js";

const sellerTypes = [
    {name: 'Broker', value: 'broker'},
    {name: 'Owner', value: 'private'},
];

const props = defineProps(['modelValue']);
const emit = defineEmits(['update:modelValue']);

const form = useForm({
    sellerType: props.modelValue.sellerType || null,
    percentage: props.modelValue.percentage || 2,
    phoneNumber: props.modelValue.phoneNumber || usePage().props.auth.user.phone_number,
    carPlateType: props.modelValue.carPlateType || null,
    isBankDebtFree: props.modelValue.isBankDebtFree || 1,
    bankDebtAmount: props.modelValue.bankDebtAmount || null,
    hasClearance: props.modelValue.hasClearance || 1,
});

watch(form, (newForm) => {
    emit('update:modelValue', newForm);
}, {deep: true});

// Todo: The percentage should be 0 if the seller is an owner
watch(() => form.sellerType, (value) => {
    if (value === 'owner') {
        form.percentage = 0;
    }
});

const carPlateTypes = [
    {value:1, name: 'Taxi'},
    {value:2, name: 'Private'},
    {value: 3, name: 'Company'},
];
</script>

<template>
    <div class="flex flex-col space-y-4">
        <div class="flex flex-col space-y-2">
            <InputLabel>Car Plate Type</InputLabel>
            <Select v-model="form.carPlateType">
                <SelectTrigger>
                    <SelectValue placeholder="Select Car Plate Type"/>
                </SelectTrigger>
                <SelectContent>
                    <SelectGroup>
                        <SelectItem v-for="item in carPlateTypes" :key="item.value" :value="item.value">
                            <span :class="[item.value === 1 ? 'bg-red-600 text-white' : item.value === 2? 'bg-blue-600 text-white' : item.value === 3 ? 'bg-emerald-400 text-white' :'']" class="px-2 font-semibold rounded-lg">
                                {{item.value}}
                            </span>
                            <span class="pl-2">
                               {{ item.name }}
                           </span>
                        </SelectItem>
                    </SelectGroup>
                </SelectContent>
            </Select>
        </div>

        <div class="flex flex-col space-y-4 w-full justify-between">

        <div v-if="form.carPlateType === 3" class="flex items-center py-2 space-x-4">
            <Switch @update:checked="form.hasClearance = !form.hasClearance"
                    :checked="form.hasClearance"/>
            <InputLabel>Has Company(Tax) Clearance?</InputLabel>
        </div>

        <div  class="flex items-center py-2 space-x-4">
            <Switch @update:checked="form.isBankDebtFree = !form.isBankDebtFree"
                    :checked="form.isBankDebtFree"/>
            <InputLabel>Is Bank Debt Free?</InputLabel>
        </div>
        </div>

        <div v-if="!form.isBankDebtFree" class="flex flex-col space-y-2">
            <InputLabel>Debt Amount</InputLabel>
            <Input v-model="form.bankDebtAmount" placeholder="Ex: 672390 Br"/>
        </div>

        <div class="flex flex-col space-y-2">
            <InputLabel>Who are you?</InputLabel>
            <Select v-model="form.sellerType">
                <SelectTrigger>
                    <SelectValue placeholder="Select Seller Type"/>
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
            <InputLabel>Percentage %</InputLabel>
            <Input v-model="form.percentage" placeholder="2%"/>
        </div>

        <div  class="flex flex-col space-y-2">
            <InputLabel>Post Phone Number</InputLabel>
            <Input v-model="form.phoneNumber" placeholder="0912342312"/>
        </div>
    </div>
</template>

<style scoped>

</style>
