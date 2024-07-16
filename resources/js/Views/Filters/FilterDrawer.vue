<script setup xmlns="http://www.w3.org/1999/html">
import {
    DrawerContent,
    DrawerOverlay,
    DrawerPortal,
    DrawerRoot,
    DrawerTrigger
} from "vaul-vue";
import {computed, ref} from "vue";
import {
    CalendarDays,
    Car,
    Cog,
    BadgeDollarSign,
    Fuel,
    Palette,
    Percent,
    RectangleHorizontal,
    X,
    MapPin, Gauge
} from "lucide-vue-next";
import MobileFilters from "@/Views/Filters/MobileFilters.vue";
import Header from "@/Components/Header.vue";
import InputRangeFilter from "@/Views/Filters/InputRangeFilter.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {debounce, upperCase} from "lodash";
import {router, usePage} from "@inertiajs/vue3";
import CheckBoxFilter from "@/Views/Filters/CheckBoxFilter.vue";

const props = defineProps({
    isDrawerOpen: {
        type: Boolean,
        default: false
    }
})

const emit = defineEmits(['loading']);

const isDrawerOpen = ref(props.isDrawerOpen);

const transmissionTypes = [
    {name: 'Automatic', value: 'automatic'},
    {name: 'Manual', value: 'manual'},
    {name: 'Semi-Automatic', value: 'semi-automatic'},
];

const plateTypes = [
    {value: 1, name: 'Taxi'},
    {value: 2, name: 'Private'},
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
const cities = computed(() => usePage().props.cities);


function setDrawerOpen(val) {
    isDrawerOpen.value = val;
}

const selected = ref(null);

function setupSelected(item) {
    selected.value = item;
}

const search = debounce(() => {
    emit('loading', true);
    router.get(
        "/car",
        {
            filters: selectedFilters.value
        },
        {
            preserveState: true,
            preserveScroll: true,
            replace: true,
            onFinish: () => {
                emit('loading', false);
            }
        }
    );
}, 900);

const selectedFilters = ref(usePage().props.filters || {
    carConditionType: [],
    sellerType: [],
    fuelType: [],
    transmissionType: [],
    exteriorColor: [],
    carBrands: [],
    year: [],
    price: [],
    mileage: [],
    plateTypes: [],
    location: []

});

function updateChecked(checked, category) {
    selectedFilters.value[category] = checked;
}

function handleRangeUpdate(range, category) {
    selectedFilters.value[category] = range;
}

function applySearch(){
    setDrawerOpen(false);
    search();
}

</script>

<template>
    <DrawerRoot :open="isDrawerOpen" @update:open="setDrawerOpen">
        <DrawerTrigger>
            <MobileFilters @selected="setupSelected"/>
        </DrawerTrigger>
        <DrawerPortal>
            <DrawerOverlay class="z-50 fixed bg-black/80 inset-0"/>
            <DrawerContent
                class="bg-white flex flex-col rounded-t-xl !h-3/5 max-h-[calc(100%-(env(safe-area-inset-top)+75px+1rem))] fixed bottom-0 left-0 right-0 z-[60]">
                <div class="w-full rounded-t-xl text-black flex flex-col space-y-2 px-4 overflow-y-auto">
                    <div class=" mx-auto w-14 h-1.5 flex-shrink-0 rounded-full bg-gray-300 my-5 overflow-y-auto"/>

                    <CheckBoxFilter v-if="selected === 'seller_type'"
                                    :initial-checked-items="selectedFilters.sellerType"
                                    @update:checked="updateChecked"
                                    :icon="Percent" title="Seller Type"
                                    :items="sellerType"/>

                    <CheckBoxFilter v-else-if="selected === 'fuel_type'"
                                    :initial-checked-items="selectedFilters.fuelType"
                                    @update:checked="updateChecked"
                                    :icon="Fuel" title="Fuel Type"
                                    :items="fuelTypes"/>

                    <CheckBoxFilter v-else-if="selected === 'transmission'"
                                    :initial-checked-items="selectedFilters.transmissionType"
                                    @update:checked="updateChecked"
                                    :icon="Cog"
                                    title="Transmission Type"
                                    :items="transmissionTypes"/>

                    <CheckBoxFilter v-else-if="selected === 'plate_type'"
                                    :initial-checked-items="selectedFilters.plateTypes"
                                    @update:checked="updateChecked"
                                    :icon="RectangleHorizontal"
                                    title="Plate Type"
                                    :items="plateTypes"
                                    show-plate-info/>

                    <CheckBoxFilter v-else-if="selected === 'color'"
                                    :initial-checked-items="selectedFilters.exteriorColor"
                                    @update:checked="updateChecked"
                                    :icon="Palette"
                                    title="Exterior Color"
                                    :items="colors" show-color-badge/>

                    <CheckBoxFilter v-else-if="selected === 'car_brands'"
                                    :initial-checked-items="selectedFilters.carBrands"
                                    @update:checked="updateChecked"
                                    title="Car Brands" :icon="Car" :items="carBrands"/>

                    <CheckBoxFilter v-else-if="selected === 'condition'"
                                    :initial-checked-items="selectedFilters.carConditionType"
                                    @update:checked="updateChecked"
                                    :icon="Percent"
                                    title="Car Condition Type"
                                    :items="carConditionTypes"/>

                    <CheckBoxFilter v-else-if="selected === 'location'"
                                    :initial-checked-items="selectedFilters.location"
                                    @update:checked="updateChecked" :icon="MapPin"
                                    title="Location"
                                    :items="cities"/>

                    <InputRangeFilter :initial-from="selectedFilters.price?.from"
                                      :initial-to="selectedFilters.price?.to"
                                      v-else-if="selected === 'price'"
                                      alignment="vertical" :title="selected"
                                      :icon="BadgeDollarSign"
                                      @update:range="handleRangeUpdate"/>

                    <InputRangeFilter :initial-from="selectedFilters.year?.from"
                                      :initial-to="selectedFilters.year?.to"
                                      v-else-if="selected === 'year'"
                                      title="Year"
                                      alignment="vertical"
                                      :title="selected"
                                      :icon="CalendarDays"
                                      @update:range="handleRangeUpdate"/>


                    <InputRangeFilter v-else-if="selected === 'mileage'"
                                      title="Mileage"
                                      alignment="vertical"
                                      :title="selected"
                                      :icon="Gauge"
                                      @update:range="handleRangeUpdate"/>
                    <PrimaryButton @click="applySearch" class="!my-4" >Apply</PrimaryButton>
                </div>

            </DrawerContent>
        </DrawerPortal>
    </DrawerRoot>
</template>

<style scoped></style>
