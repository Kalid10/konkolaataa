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
import {XCircle} from "lucide-vue-next";

const cars = computed(()=>usePage().props.cars);

const routeToItem = (id) => {
    router.visit(`/car/show/${id}`);
}

const isLoading = ref(false);
function checkLoading(value){
    isLoading.value = value
}
</script>

<template>
    <div class="flex flex-col space-y-6 md:space-y-3">
        <Header title="Cars" subtitle="List of Cars" />
        <FilterDrawer/>
        <div class="w-full flex justify-center md:space-x-12">
            <div class="w-4/12 h-fit hidden md:flex flex-col items-center  border border-gray-300 rounded-lg">
                <div class=" flex w-full items-center justify-center space-x-3 pt-4 pb-2">
<!--                    <XCircle @click="clearFilters = true"  size="25" class="hover:text-black hover:scale-110 cursor-pointer text-gray-50 fill-red-600"/>-->
                    <div class="font-bold text-2xl  text-center uppercase ">Filter Options</div>
                </div>
                <DesktopFilters @loading="checkLoading"/>
            </div>
            <div class="relative w-full h-fit items-center md:items-start md:w-9/12">
                <Loading is-full-screen v-if="isLoading"  />

                <div v-if="cars.data.length" class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:flex-wrap md:justify-between">
                    <Items @click="routeToItem(car.id)" v-for="car in cars.data" :car="car" :seller-type="i % 2 === 0 ? 'Private Seller':'Broker'" />
                    <Pagination :links="cars.links"/>
                </div>
                <Error v-else error="No cars found"/>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
