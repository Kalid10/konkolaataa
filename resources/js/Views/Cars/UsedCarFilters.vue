<script setup>

import SelectBoxRangeFilter from "@/Views/Filters/SelectBoxRangeFilter.vue";
import {Input} from "@/Components/shadcn/ui/input/index.js";
import InputRangeFilter from "@/Views/Filters/InputRangeFilter.vue";
import CheckBoxFilter from "@/Views/Filters/CheckBoxFilter.vue";
import {Cog, Fuel, CalendarDays, Gauge, DollarSign, Palette} from "lucide-vue-next";

const minYears = [
    {name: '2020', value: '2020'},
    {name: '2019', value: '2019'},
    {name: '2018', value: '2018'},
    {name: '2017', value: '2017'},
];
const maxYears = [
    {name: '2020', value: '2020'},
    {name: '2019', value: '2019'},
    {name: '2018', value: '2018'},
    {name: '2017', value: '2017'},
];

const fuelTypes = [
    {name: 'Petrol', value: 'petrol'},
    {name: 'Diesel', value: 'diesel'},
    {name: 'Electric', value: 'electric'},
    {name: 'Hybrid', value: 'hybrid'},
];

const transmissionTypes = [
    {name: 'Automatic', value: 'automatic'},
    {name: 'Manual', value: 'manual'},
    {name: 'Semi-Automatic', value: 'semi-automatic'},
];

const colors = [
    {name: 'Red', value: '#FF0000'},
    {name: 'Blue', value: '#0000FF'},
    {name: 'Green', value: '#008000'},
    {name: 'Yellow', value: '#FFFF00'},
    {name: 'Black', value: '#000000'},
    {name: 'White', value: '#FFFFFF'},
    {name: 'Silver', value: '#C0C0C0'},
    {name: 'Grey', value: '#808080'},
    {name: 'Brown', value: '#A52A2A'},
    {name: 'Orange', value: '#FFA500'},
    {name: 'Purple', value: '#800080'},
]
</script>

<template>
    <div class="flex flex-col divide-y space-y-2 divide-gray-200">
        <Input class="rounded-full h-fit py-2 mt-5 mb-3 border-gray-400" placeholder="Quick Search"/>
        <InputRangeFilter title="Price" :icon="DollarSign"/>
        <SelectBoxRangeFilter :icon="CalendarDays" :select-box-range-filter2="maxYears" :select-box-range-filter="minYears" title="Year" />
        <InputRangeFilter :icon="Gauge" title="Mileage" input-placeholder="0" input-placeholder2="17000"/>
        <CheckBoxFilter :icon="Fuel" title="Fuel Type" :items="fuelTypes"/>
        <CheckBoxFilter :icon="Cog" title="Transmission" :items="transmissionTypes"/>
        <CheckBoxFilter title="Exterior Color" :icon="Palette" :items="colors" >
        </CheckBoxFilter>
    </div>
</template>

<style scoped>

</style>
