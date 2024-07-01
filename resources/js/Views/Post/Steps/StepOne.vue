<script setup>

import InputLabel from "@/Components/InputLabel.vue";
import {Input} from "@/Components/shadcn/ui/input/index.js";
import {Textarea} from "@/Components/shadcn/ui/textarea/index.js";
import {
    Select,
    SelectContent,
    SelectGroup,
    SelectItem,
    SelectTrigger,
    SelectValue
} from "@/Components/shadcn/ui/select/index.js";
import {computed} from "vue";
import {useForm, usePage} from "@inertiajs/vue3";

const carBrands = computed(()=> usePage().props.carBrands);

const years = [
    '2022',
    '2021',
    '2020',
    '2019',
    '2018',
    '2017',
    '2016',
    '2015',
    '2014',
    '2013',
    '2012',
    '2011',
    '2010',
    '2009',
    '2008',
    '2007',
    '2006',
    '2005',
    '2004',
    '2003',
    '2002',
    '2001',
    '2000',
    '1999',
    '1998',
    '1997',
    '1996',
    '1995',
    '1994',
    '1993',
    '1992',
    '1991',
    '1990',
    '1989',
    '1988',
    '1987',
    '1986',
    '1985',
    '1984',
    '1983',
    '1982',
    '1981',
    '1980',
];

const form = useForm({
    carBrandId: null,
    title: null,
    description: null,
    carCondition: null,
})
</script>

<template>
    <div class="flex flex-col space-y-4 p-2">

        <div class="flex flex-col space-y-2">
            <InputLabel>Car Brand</InputLabel>
            <Select v-model="form.carBrandId">
                <SelectTrigger>
                    <SelectValue placeholder="Select Car Brand" />
                </SelectTrigger>
                <SelectContent>
                    <SelectGroup>
                        <SelectItem v-for="item in carBrands" :value="item.id">
                            {{ item.name }}
                        </SelectItem>
                    </SelectGroup>
                </SelectContent>
            </Select>
        </div>

        <div class="flex flex-col space-y-2">
            <InputLabel>Year</InputLabel>
            <Select>
                <SelectTrigger>
                    <SelectValue placeholder="Select Year" />
                </SelectTrigger>
                <SelectContent>
                    <SelectGroup>
                        <SelectItem v-for="item in years" :value="item">
                            {{ item }}
                        </SelectItem>
                    </SelectGroup>
                </SelectContent>
            </Select>
        </div>

        <div class="flex flex-col space-y-2">
            <InputLabel>Car Model</InputLabel>
            <Input v-model="form.title" placeholder="Eg: Suzuki Dzire 2022"/>
        </div>

        <div class="flex flex-col space-y-2">
            <InputLabel>Describe your car</InputLabel>
            <Textarea rows="4"  placeholder="Eg: Suzuki Dzire 2022"/>
        </div>

    </div>
</template>

<style scoped>

</style>
