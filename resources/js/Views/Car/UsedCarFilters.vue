<script setup>

import SelectBoxRangeFilter from "@/Views/Filters/SelectBoxRangeFilter.vue";
import {Input} from "@/Components/shadcn/ui/input/index.js";
import InputRangeFilter from "@/Views/Filters/InputRangeFilter.vue";
import CheckBoxFilter from "@/Views/Filters/CheckBoxFilter.vue";
import {Cog, Fuel, CalendarDays, Gauge, DollarSign, Palette, Percent, Car} from "lucide-vue-next";
import {computed, ref} from "vue";
import {router, usePage} from "@inertiajs/vue3";
import { debounce } from "lodash";
import Loading from "@/Components/Loading.vue";

const minYears = [
    {name: '2020', value: '2020'},
    {name: '2019', value: '2019'},
    {name: '2018', value: '2018'},
    {name: '2017', value: '2017'},
    {name: '2016', value: '2016'},
    {name: '2015', value: '2015'},
    {name: '2014', value: '2014'},
    {name: '2013', value: '2013'},
    {name: '2012', value: '2012'},
    {name: '2011', value: '2011'},
    {name: '2010', value: '2010'},
];
const maxYears = [
    {name: '2020', value: '2020'},
    {name: '2019', value: '2019'},
    {name: '2018', value: '2018'},
    {name: '2017', value: '2017'},
    {name: '2016', value: '2016'},
    {name: '2015', value: '2015'},
    {name: '2014', value: '2014'},
    {name: '2013', value: '2013'},
    {name: '2012', value: '2012'},
    {name: '2011', value: '2011'},
    {name: '2010', value: '2010'},
];


const transmissionTypes = [
    {name: 'Automatic', value: 'automatic'},
    {name: 'Manual', value: 'manual'},
    {name: 'Semi-Automatic', value: 'semi-automatic'},
];

const sellerType = [
    {name: 'Private', value: 'private'},
    {name: 'Broker', value: 'broker'},
];

const fuelTypes = computed(() => usePage().props.fuelTypes);
const carConditionTypes = computed(() => usePage().props.carConditionTypes);
const carBrands = computed(() => usePage().props.carBrands);
const colors = computed(() => usePage().props.colors);

const selectedFilters = ref(usePage().props.filters || {
    carConditionType: [],
    sellerType: [],
    fuelType: [],
    transmissionType: [],
    exteriorColor: [],
    carBrands: [],
    year: [],
});
function updateChecked(checked, category) {
    selectedFilters.value[category] = checked;
    search();
}

const isLoading = ref(false);
const searchKey = ref(usePage().props.search);
const search = debounce(() => {
    isLoading.value = true;
    router.get(
        "/car",
        {
            search: searchKey.value,
            filters: selectedFilters.value
        },
        {
            preserveState: true,
            replace: true,
            onFinish: () => isLoading.value = false
        }
    );
}, 900);

function handleRangeUpdate(range) {
    selectedFilters.value.year = range;
    search();
}
</script>

<template>
    <Loading v-if="isLoading" is-full-screen />
    <div class="flex flex-col divide-y space-y-2 divide-gray-200">
        <Input class="rounded-full h-fit py-2 mt-5 mb-3 border-gray-400" placeholder="Quick Search" v-model="searchKey" @keyup="search"/>
        <InputRangeFilter title="Price" :icon="DollarSign"/>
        <SelectBoxRangeFilter
            :initial-from="selectedFilters.year.from"
            :initial-to="selectedFilters.year.to"
            @update:range="handleRangeUpdate"
            :icon="CalendarDays" :select-box-range-filter2="maxYears" :select-box-range-filter="minYears" title="Year" />
        <InputRangeFilter :icon="Gauge" title="Mileage" input-placeholder="0" input-placeholder2="17000"/>
        <CheckBoxFilter :initial-checked-items="selectedFilters.carConditionType" @update:checked="updateChecked" :icon="Percent" title="Car Condition Type" :items="carConditionTypes" />
        <CheckBoxFilter :initial-checked-items="selectedFilters.sellerType" @update:checked="updateChecked" :icon="Percent" title="Seller Type" :items="sellerType" />
        <CheckBoxFilter :initial-checked-items="selectedFilters.fuelType" @update:checked="updateChecked"  :icon="Fuel" title="Fuel Type" :items="fuelTypes"/>
        <CheckBoxFilter :initial-checked-items="selectedFilters.transmissionType" @update:checked="updateChecked" :icon="Cog" title="Transmission Type" :items="transmissionTypes"/>
        <CheckBoxFilter :initial-checked-items="selectedFilters.exteriorColor" @update:checked="updateChecked" :icon="Palette" title="Exterior Color"  :items="colors" :show-color-badge="true"/>
        <CheckBoxFilter :initial-checked-items="selectedFilters.carBrands" @update:checked="updateChecked" title="Car Brands" :icon="Car" :items="carBrands" />
    </div>
</template>

<style scoped>

</style>
