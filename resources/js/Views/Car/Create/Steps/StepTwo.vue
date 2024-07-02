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
import {Input} from "@/Components/shadcn/ui/input/index.js";
import {computed, watch} from "vue";
import {useForm, usePage} from "@inertiajs/vue3";

const props = defineProps(['modelValue']);
const emit = defineEmits(['update:modelValue']);

const form = useForm({
    carConditionTypeId: props.modelValue.carConditionTypeId || null,
    carBodyTypeId: props.modelValue.carBodyTypeId || null,
    transmissionType: props.modelValue.transmissionType || null,
    fuelTypeId: props.modelValue.fuelTypeId || null,
    exteriorColorId: props.modelValue.exteriorColorId || null,
    interiorColorId: props.modelValue.interiorColorId || null,
    engineTypeId: props.modelValue.engineTypeId || null,
    mileage: props.modelValue.mileage || null,

});

watch(form, (newForm) => {
    emit('update:modelValue', newForm);
}, {deep: true});

const transmissionTypes = [
    {name: 'Manual', value: 'manual'},
    {name: 'Automatic', value: 'automatic'},
    {name: 'Semi-Automatic', value: 'semi_automatic'},
];

const fuelTypes = computed(() => usePage().props.fuelTypes);
const engineTypes = computed(() => usePage().props.engineTypes);
const colors = computed(() => usePage().props.colors);
const carConditionTypes = computed(() => usePage().props.carConditionTypes);
const carBodyTypes = computed(() => usePage().props.carBodyTypes);

</script>

<template>
    <div class="flex flex-col space-y-4">
        <div class="flex flex-col space-y-2">
            <InputLabel>What type of car are you selling?</InputLabel>
            <Select v-model="form.carConditionTypeId">
                <SelectTrigger>
                    <SelectValue placeholder="Select Car Condition" />
                </SelectTrigger>
                <SelectContent>
                    <SelectGroup>
                        <SelectItem v-for="item in carConditionTypes" :value="item.id">
                           <span class="uppercase">
                            {{ item.name }}
                           </span>
                        </SelectItem>
                    </SelectGroup>
                </SelectContent>
            </Select>
        </div>

        <div class="flex flex-col space-y-2">
            <InputLabel>Mileage</InputLabel>
            <Input v-model="form.mileage" placeholder="Eg: 10,500"/>
        </div>


        <div class="flex flex-col space-y-2">
            <InputLabel>Body Type</InputLabel>
            <Select v-model="form.carBodyTypeId">
                <SelectTrigger>
                    <SelectValue placeholder="Select Body Type" />
                </SelectTrigger>
                <SelectContent>
                    <SelectGroup>
                        <SelectItem v-for="item in carBodyTypes" :value="item.id">

                                {{ item.name }}

                        </SelectItem>
                    </SelectGroup>
                </SelectContent>
            </Select>
        </div>
        <div class="flex flex-col space-y-2">
            <InputLabel>Transmission Type</InputLabel>
            <Select v-model="form.transmissionType">
                <SelectTrigger>
                    <SelectValue placeholder="Select Transmission Type" />
                </SelectTrigger>
                <SelectContent>
                    <SelectGroup>
                        <SelectItem v-for="item in transmissionTypes" :value="item.id">
                            {{ item.name }}
                        </SelectItem>
                    </SelectGroup>
                </SelectContent>
            </Select>
        </div>

        <div class="flex flex-col space-y-2">
            <InputLabel>Fuel Type</InputLabel>
            <Select v-model="form.fuelTypeId">
                <SelectTrigger>
                    <SelectValue placeholder="Select Fuel Type" />
                </SelectTrigger>
                <SelectContent>
                    <SelectGroup>
                        <SelectItem v-for="item in fuelTypes" :value="item.id">
                           <span class="capitalize">
                               {{ item.name }}
                           </span>
                        </SelectItem>
                    </SelectGroup>
                </SelectContent>
            </Select>
        </div>

        <div class="flex flex-col space-y-2">
            <InputLabel>Exterior Color</InputLabel>
            <Select v-model="form.exteriorColorId">
                <SelectTrigger>
                    <SelectValue placeholder="Select Color" />
                </SelectTrigger>
                <SelectContent>
                    <SelectGroup>
                        <SelectItem  v-for="item in colors" :value="item.id">
                            <div class="!flex space-x-2 items-center">

                                <div class="w-3 h-3 rounded-full border border-gray-200" :style="'background-color:'+ item.name"></div>
                                <div>  {{ item.name }} </div>
                            </div>
                        </SelectItem>
                    </SelectGroup>
                </SelectContent>
            </Select>
        </div>

        <div class="flex flex-col space-y-2">
            <InputLabel>Interior Color</InputLabel>
            <Select v-model="form.interiorColorId">
                <SelectTrigger>
                    <SelectValue placeholder="Select Color" />
                </SelectTrigger>
                <SelectContent>
                    <SelectGroup>
                        <SelectItem  v-for="item in colors" :value="item.id">
                            <div class="!flex space-x-2 items-center">

                                <div class="w-3 h-3 rounded-full border border-gray-200" :style="'background-color:'+ item.name"></div>
                                <div>  {{ item.name }} </div>
                            </div>
                        </SelectItem>
                    </SelectGroup>
                </SelectContent>
            </Select>
        </div>

        <div class="flex flex-col space-y-2">
            <InputLabel>Engine Size</InputLabel>
            <Select v-model="form.engineTypeId">
                <SelectTrigger>
                    <SelectValue placeholder="Select Engine Size" />
                </SelectTrigger>
                <SelectContent>
                    <SelectGroup>
                        <SelectItem v-for="item in engineTypes" :value="item.id">
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
