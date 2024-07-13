<script setup>

import Header from "@/Components/Header.vue";
import Items from "@/Views/Car/Item.vue";
import DesktopFilters from "@/Views/Car/DesktopFilters.vue";
import FilterDrawer from "@/Views/Filters/FilterDrawer.vue";
import {computed, ref} from "vue";
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

const cars = computed(() => usePage().props.cars);
const icons = [
    {icon: Sedan, name: 'Sedan'},
    {icon: Electric, name: 'Electric'},
    {icon: SUV, name: 'SUV'},
    {icon: Pickup, name: 'Pickup'},
    {icon: Van, name: 'Van'},
    {icon: Wagon, name: 'Wagon'},
]

const routeToItem = (id) => {
    router.visit(`/car/show/${id}`);
}

const isLoading = ref(false);

function checkLoading(value) {
    isLoading.value = value
}

const searchKey = ref(usePage().props.search);
const search = debounce(() => {
    isLoading.value = true;
    router.get(
        "/car",
        {
            search: searchKey.value,
        },
        {
            preserveState: true,
            replace: true,
            onFinish: () => {
                isLoading.value = false;
            }
        }
    );
}, 900);
</script>

<template>
    <div class="flex flex-col space-y-6 md:space-y-3">
        <Input class="sm:hidden rounded-full h-fit py-2 border-2 border-gray-800" placeholder="Quick Search" v-model="searchKey"
               @keyup="search"/>
        <div class="flex justify-between">
            <div class="w-3/12 justify-center hidden md:flex">
                <Header class="hidden sm:inline-block" title="Cars" subtitle="List of Cars"/>
            </div>
            <div class="flex pl-10 md:pr-14 py-3 justify-center space-x-6 md:space-x-20 items-center overflow-x-auto hide-scrollbar w-full md:w-10/12 ">
                <div v-for="(icon, index) in icons" :key="index" class="flex flex-col space-y-2 text-center text-sm group hover:scale-105 cursor-pointer">
                    <component class="w-20 text-gray-800 cursor-pointer  group-hover:text-brand-primary"
                               :is="icon.icon"/>
                    <span class="group-hover:text-brand-primary group-hover:font-medium">{{ icon.name }}</span>
                </div>
            </div>
        </div>

        <FilterDrawer/>

        <div class="w-full flex justify-evenly md:space-x-12">
            <div class="w-4/12 h-fit hidden md:flex flex-col items-center  border border-gray-300 rounded-lg max-w-xs">
                <div class=" flex w-full items-center justify-center space-x-3 pt-4 pb-2">
                    <!--                    <XCircle @click="clearFilters = true"  size="25" class="hover:text-black hover:scale-110 cursor-pointer text-gray-50 fill-red-600"/>-->
                    <div class="font-bold text-2xl  text-center uppercase ">Filter Options</div>
                </div>
                <DesktopFilters @loading="checkLoading"/>
            </div>
            <div class="relative w-full md:w-8/12">
                <Loading v-if="isLoading" class="mt-40 md:mt-72"/>

                <div v-else-if="cars.data.length && !isLoading"
                     class="flex flex-col md:flex-row space-y-4  md:space-y-0 md:flex-wrap">
                    <Items @click="routeToItem(car.id)" v-for="car in cars.data" :car="car"
                           :seller-type="i % 2 === 0 ? 'Private Seller':'Broker'"/>
                    <Pagination :links="cars.links"/>
                </div>
                <Error v-else error="No cars found"/>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
