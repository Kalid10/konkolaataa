<script setup>
import {ref, computed, watch} from "vue";
import {useForm, usePage} from "@inertiajs/vue3";
import InputLabel from "@/Components/InputLabel.vue";
import {Textarea} from "@/Components/shadcn/ui/textarea/index.js";
import {
    Select,
    SelectContent,
    SelectGroup,
    SelectItem,
    SelectTrigger,
    SelectValue
} from "@/Components/shadcn/ui/select/index.js";

const carBrands = computed(() => usePage().props.carBrands);
const carModels = computed(() => usePage().props.carModels);
const years = [
    // ... (years array as before)
    '2022', '2021', '2020', '2019', '2018', '2017', '2016', '2015',
    '2014', '2013', '2012', '2011', '2010', '2009', '2008', '2007',
    '2006', '2005', '2004', '2003', '2002', '2001', '2000', '1999',
    '1998', '1997', '1996', '1995', '1994', '1993', '1992', '1991',
    '1990', '1989', '1988', '1987', '1986', '1985', '1984', '1983',
    '1982', '1981', '1980'
];

const carPlateTypes = [
    {value:1, name: 'Taxi'},
    {value:2, name: 'Private'},
    {value: 3, name: 'Company'},
];

const props = defineProps(['modelValue']);
const emit = defineEmits(['update:modelValue']);

const form = useForm({
    carBrandId: props.modelValue.carBrandId || carBrands.value[0].id,
    description: props.modelValue.description || 'des',
    year: props.modelValue.year || years[0],
    carModelId: props.modelValue.carModelId || carModels.value[0].id,
    carPlateType: props.modelValue.carPlateType || carPlateTypes[0].value,
});

watch(form, (newForm) => {
    emit('update:modelValue', newForm);
}, {deep: true});

const selectedCarModels = computed(() => {
    return carModels.value.filter(model => model.car_brand_id === form.carBrandId);
});
</script>

<template>
    <div class="flex flex-col space-y-4 p-2">
        <div class="flex flex-col space-y-2">
            <InputLabel>Car Brand</InputLabel>
            <Select v-model="form.carBrandId">
                <SelectTrigger>
                    <SelectValue placeholder="Select Car Brand"/>
                </SelectTrigger>
                <SelectContent>
                    <SelectGroup>
                        <SelectItem v-for="item in carBrands" :key="item.id" :value="item.id">
                            {{ item.name }}
                        </SelectItem>
                    </SelectGroup>
                </SelectContent>
            </Select>
        </div>

        <div class="flex flex-col space-y-2">
            <InputLabel>Car Model</InputLabel>
            <Select :disabled="!selectedCarModels.length" v-model="form.carModelId">
                <SelectTrigger>
                    <SelectValue placeholder="Select Car Model"/>
                </SelectTrigger>
                <SelectContent>
                    <SelectGroup>
                        <SelectItem v-for="item in selectedCarModels" :key="item.id" :value="item.id">
                            {{ item.name }}
                        </SelectItem>
                    </SelectGroup>
                </SelectContent>
            </Select>
        </div>

        <div class="flex flex-col space-y-2">
            <InputLabel>Year</InputLabel>
            <Select v-model="form.year">
                <SelectTrigger>
                    <SelectValue placeholder="Select Year"/>
                </SelectTrigger>
                <SelectContent>
                    <SelectGroup>
                        <SelectItem v-for="item in years" :key="item" :value="item">
                            {{ item }}
                        </SelectItem>
                    </SelectGroup>
                </SelectContent>
            </Select>
        </div>

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

        <div class="flex flex-col space-y-2">
            <InputLabel>Describe your car</InputLabel>
            <Textarea rows="4" v-model="form.description" placeholder="Eg: Suzuki Dzire 2022"/>
        </div>
    </div>
</template>

<style scoped>
/* Add any additional styles here */
</style>
