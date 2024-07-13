<script setup>

import {Input} from "@/Components/shadcn/ui/input/index.js";
import InputRangeFilter from "@/Views/Filters/InputRangeFilter.vue";
import CheckBoxFilter from "@/Views/Filters/CheckBoxFilter.vue";
import {Cog, Fuel, CalendarDays, Gauge, DollarSign, Palette, Percent, Car, RectangleHorizontal} from "lucide-vue-next";
import {computed, ref, watch} from "vue";
import {router, usePage} from "@inertiajs/vue3";
import { debounce } from "lodash";

const emit = defineEmits(['loading']);
const props = defineProps({
    clearFilters: {
        type: Boolean,
        default: false
    }
})

const transmissionTypes = [
    {name: 'Automatic', value: 'automatic'},
    {name: 'Manual', value: 'manual'},
    {name: 'Semi-Automatic', value: 'semi-automatic'},
];

const plateTypes = [
    {value:1, name: 'Taxi'},
    {value:2, name: 'Private'},
    {value: 3, name: 'Company'},
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
    price:[],
    mileage: [],
    plateTypes: [],

});
function updateChecked(checked, category) {
    selectedFilters.value[category] = checked;
    search();
}

const searchKey = ref(usePage().props.search);
const search = debounce(() => {
   emit('loading', true);
    router.get(
        "/car",
        {
            search: searchKey.value,
            filters: selectedFilters.value
        },
        {
            preserveState: true,
            replace: true,
            onFinish: () => {
                emit('loading', false);
            }
        }
    );
}, 900);

function handleRangeUpdate(range,category) {
    selectedFilters.value[category] = range;
    search();
}

</script>

<template>
    <div class="flex flex-col divide-y w-10/12 space-y-2 pb-4 divide-gray-200">
        <Input class="rounded-full h-fit py-2 mt-5 mb-3 border-gray-400" placeholder="Quick Search" v-model="searchKey" @keyup="search"/>
        <CheckBoxFilter :initial-checked-items="selectedFilters.carConditionType" @update:checked="updateChecked" :icon="Percent" title="Car Condition Type" :items="carConditionTypes" />
        <InputRangeFilter
            :initial-from="selectedFilters.price?.from"
            :initial-to="selectedFilters.price?.to"
            @update:range="handleRangeUpdate" title="Price" :icon="DollarSign"/>
        <InputRangeFilter
            :initial-from="selectedFilters.year?.from"
            :initial-to="selectedFilters.year?.to"
            @update:range="handleRangeUpdate"
            :icon="CalendarDays"
            title="Year" />
        <InputRangeFilter @update:range="handleRangeUpdate" :icon="Gauge" title="Mileage" input-placeholder="0" input-placeholder2="17000"/>
        <CheckBoxFilter :initial-checked-items="selectedFilters.sellerType" @update:checked="updateChecked" :icon="Percent" title="Seller Type" :items="sellerType" />
        <CheckBoxFilter :initial-checked-items="selectedFilters.fuelType" @update:checked="updateChecked"  :icon="Fuel" title="Fuel Type" :items="fuelTypes"/>
        <CheckBoxFilter :initial-checked-items="selectedFilters.transmissionType" @update:checked="updateChecked" :icon="Cog" title="Transmission Type" :items="transmissionTypes"/>
        <CheckBoxFilter :initial-checked-items="selectedFilters.plateTypes" @update:checked="updateChecked" :icon="RectangleHorizontal" title="Plate Type" :items="plateTypes" show-plate-info/>
        <CheckBoxFilter :initial-checked-items="selectedFilters.exteriorColor" @update:checked="updateChecked" :icon="Palette" title="Exterior Color"  :items="colors" show-color-badge/>
        <CheckBoxFilter :initial-checked-items="selectedFilters.carBrands" @update:checked="updateChecked" title="Car Brands" :icon="Car" :items="carBrands" />
    </div>
</template>

<style scoped>

</style>
