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
import {Input} from "@/Components/shadcn/ui/input/index.js";

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

const props = defineProps(['modelValue']);
const emit = defineEmits(['update:modelValue']);

const form = useForm({
    carBrandId: props.modelValue.carBrandId || null,
    description: props.modelValue.description || null,
    year: props.modelValue.year || null,
    carModelId: props.modelValue.carModelId || null,
});

watch(form, (newForm) => {
    emit('update:modelValue', newForm);
}, {deep: true});

const selectedCarModels = computed(() => {
    return carModels.value.filter(model => model.car_brand_id === form.carBrandId);
});


</script>

<template>
    <div class="flex flex-col space-y-4">
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
                        <SelectItem value="other">
                            Other
                        </SelectItem>
                    </SelectGroup>
                </SelectContent>
            </Select>
            <div class="flex flex-col space-y-2 pt-2">
            <InputLabel v-if="form.carBrandId ==='other'">Car Brand Name</InputLabel>
            <Input  v-if="form.carBrandId ==='other'" placeholder="Other Car Brand Name"></Input>
            </div>
        </div>

        <div class="flex flex-col space-y-2">
            <InputLabel>Car Model</InputLabel>
            <Input v-model="form.carModelId" v-if="form.carBrandId ==='other'" placeholder="Other Car Model"></Input>
            <Select v-else :disabled="!selectedCarModels.length" v-model="form.carModelId">
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

        <div class="flex flex-col space-y-2 pt-2">
            <InputLabel>Describe your car <span class="text-xs ">(Optional)</span></InputLabel>
            <Textarea rows="4" v-model="form.description" placeholder="Eg: Has been working ride for six months"/>
        </div>
    </div>
</template>
