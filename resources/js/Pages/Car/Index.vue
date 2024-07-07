<script setup>

import Header from "@/Components/Header.vue";
import Items from "@/Views/Car/Item.vue";
import DesktopFilter from "@/Views/Filters/DesktopFilters.vue";
import UsedCarFilters from "@/Views/Car/UsedCarFilters.vue";
import NewCarFilters from "@/Views/Car/NewCarFilters.vue";
import FilterDrawer from "@/Views/Filters/FilterDrawer.vue";
import {computed} from "vue";
import {router, usePage} from "@inertiajs/vue3";
import Pagination from "@/Components/Pagination.vue";
import {LoaderCircle} from "lucide-vue-next";
import Loading from "@/Components/Loading.vue";
import Error from "@/Components/Error.vue";

const cars = computed(()=>usePage().props.cars);

const routeToItem = (id) => {
    router.visit(`/car/show/${id}`);
}
</script>

<template>
    <div class="flex flex-col space-y-6 md:space-y-3">
        <Header title="Cars" subtitle="List of Cars" />
        <FilterDrawer/>
        <div class="w-full flex justify-center md:space-x-12">
            <div class="w-3/12 h-fit hidden md:flex flex-col items-center px-5 py-3 border border-gray-300 rounded-lg">
                <DesktopFilter>
                    <template #used_tab>
                        <UsedCarFilters/>
                    </template>
                    <template #new_tab>
                        <NewCarFilters/>
                    </template>
                </DesktopFilter>
            </div>
            <div v-if="cars.data.length" class="w-full h-fit items-center md:items-start md:w-9/12 flex flex-col md:flex-row space-y-4 md:space-y-0 md:flex-wrap md:justify-between">
                <Items @click="routeToItem(car.id)" v-for="car in cars.data" :car="car" :seller-type="i % 2 === 0 ? 'Private Seller':'Broker'" />
                <Pagination :links="cars.links"/>
            </div>
            <Error v-else error="No cars found"/>
        </div>
    </div>
</template>

<style scoped>

</style>
