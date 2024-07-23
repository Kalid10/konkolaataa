<script setup>

import Header from "@/Components/Header.vue";
import Items from "@/Views/Car/Item.vue";
import DesktopFilters from "@/Views/Car/DesktopFilters.vue";
import FilterDrawer from "@/Views/Filters/FilterDrawer.vue";
import {computed, ref, watch} from "vue";
import {router, usePage} from "@inertiajs/vue3";
import Pagination from "@/Components/Pagination.vue";
import Error from "@/Components/Error.vue";
import Loading from "@/Components/Loading.vue";
import {Input} from "@/Components/shadcn/ui/input/index.js";
import {debounce} from "lodash";
import SUV from "@/Icons/SUV.vue";
import Pickup from "@/Icons/Pickup.vue";
import Van from "@/Icons/Van.vue";
import Sedan from "@/Icons/Sedan.vue";
import Electric from "@/Icons/Electric.vue";
import Wagon from "@/Icons/Wagon.vue";
import {Search} from "lucide-vue-next";

const cars = computed(() => usePage().props.cars);
const icons = [
    {icon: Sedan, name: 'Sedan', id: 1},
    {icon: Electric, name: 'Electric', id: 6},
    {icon: SUV, name: 'SUV', id: 2},
    {icon: Pickup, name: 'Pickup', id:5},
    {icon: Van, name: 'Van', id:4},
    {icon: Wagon, name: 'Wagon', id: 3},
]

const routeToItem = (id) => {
    router.visit(`/car/show/${id}`);
}

const isLoading = ref(false);
function checkLoading(value) {
    isLoading.value = value
}

const selectedBodyTypeId = ref(null);
const searchKey = ref(usePage().props.search);
const search = debounce(() => {
    isLoading.value = true;
    router.get(
        "/car",
        {
            search: searchKey.value,
            filters: { carBodyType: selectedBodyTypeId.value !== null ? { id: selectedBodyTypeId.value} : {}}},
        {
            preserveState: true,
            replace: true,
            onFinish: () => {
                isLoading.value = false;
            }
        }
    );
}, 900);

watch(selectedBodyTypeId, () => {
    search();
})
</script>

<template>
    <div class="flex flex-col space-y-6 md:space-y-3">
        <div class="sm:hidden flex w-full h-full items-center rounded-full border-2 ">
            <div class=" border-2 border-r-0 border-gray-800 h-10 py-2 w-fit pl-2 pr-1 rounded-l-full flex items-center justify-center">
                <Search size="20" />
            </div>
           <Input class=" h-10 focus-visible:ring-0 !ring-offset-0 rounded-none py-2 rounded-r-full border-2 border-l-0 border-gray-800" placeholder="Quick Search" v-model="searchKey"
               @keyup="search"/>

        </div>

            <div class="flex md:pl-10 space-x-8 md:space-x-0 md:pr-14 py-3 justify-evenly items-center overflow-x-auto hide-scrollbar w-full">
                <div @click="selectedBodyTypeId = icon.id" v-for="(icon, index) in icons" :key="index" class="flex flex-col space-y-2 text-center text-sm group hover:scale-105 cursor-pointer">
                    <component class="w-16 md:w-20 text-gray-800 cursor-pointer  group-hover:text-brand-primary"
                               :is="icon.icon"/>
                    <span class="group-hover:text-brand-primary group-hover:font-medium">{{ icon.name }}</span>
                </div>
            </div>

        <FilterDrawer @loading="checkLoading"/>

        <div class="w-full flex justify-evenly md:space-x-12">
            <div class="w-4/12 h-fit hidden md:flex flex-col items-center border border-gray-300 rounded-lg max-w-xs">
                <div class=" flex w-full items-center justify-center space-x-3 pt-4 pb-2">
                    <!--                    <XCircle @click="clearFilters = true"  size="25" class="hover:text-black hover:scale-110 cursor-pointer text-gray-50 fill-red-600"/>-->
                    <div class="font-bold text-2xl  text-center uppercase ">Filter Options</div>
                </div>
                <DesktopFilters @loading="checkLoading"/>
            </div>
            <div class="relative w-full md:w-8/12">
                <Loading v-if="isLoading" class="mt-40 md:mt-72"/>

                <div v-else-if="cars.data.length && !isLoading"
                     class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <Items @click="routeToItem(car.id)" v-for="(car, i) in cars.data" :key="car.id" :car="car"
                           :seller-type="i % 2 === 0 ? 'Private Seller':'Broker'"/>
                </div>
                <Error v-else error="No cars found"/>
                <Pagination :links="cars.links"/>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
