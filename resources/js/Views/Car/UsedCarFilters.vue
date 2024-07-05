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
];
const maxYears = [
    {name: '2020', value: '2020'},
    {name: '2019', value: '2019'},
    {name: '2018', value: '2018'},
    {name: '2017', value: '2017'},
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

const selectedFilters = ref({
    carConditionType: [],
    sellerType: [],
    fuelType: [],
    transmissionType: [],
    exteriorColor: [],
    carBrands: [],
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
</script>

<template>
    <Loading v-if="isLoading" is-full-screen />
    <div class="flex flex-col divide-y space-y-2 divide-gray-200">
        <Input class="rounded-full h-fit py-2 mt-5 mb-3 border-gray-400" placeholder="Quick Search" v-model="searchKey" @keyup="search"/>
        <InputRangeFilter title="Price" :icon="DollarSign"/>
        <SelectBoxRangeFilter :icon="CalendarDays" :select-box-range-filter2="maxYears" :select-box-range-filter="minYears" title="Year" />
        <InputRangeFilter :icon="Gauge" title="Mileage" input-placeholder="0" input-placeholder2="17000"/>
        <CheckBoxFilter @update:checked="updateChecked" :icon="Percent" title="Car Condition Type" :items="carConditionTypes" />
        <CheckBoxFilter @update:checked="updateChecked" :icon="Percent" title="Seller Type" :items="sellerType" />
        <CheckBoxFilter @update:checked="updateChecked"  :icon="Fuel" title="Fuel Type" :items="fuelTypes"/>
        <CheckBoxFilter @update:checked="updateChecked" :icon="Cog" title="Transmission Type" :items="transmissionTypes"/>
        <CheckBoxFilter @update:checked="updateChecked" :icon="Palette" title="Exterior Color"  :items="colors" :show-color-badge="true"/>
        <CheckBoxFilter @update:checked="updateChecked" title="Car Brands" :icon="Car" :items="carBrands" />
    </div>
</template>

<style scoped>

</style>
