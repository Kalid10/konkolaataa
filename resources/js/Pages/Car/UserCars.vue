<script setup>

import Items from "@/Views/Car/Item.vue";
import Pagination from "@/Components/Pagination.vue";
import {computed} from "vue";
import {router, usePage} from "@inertiajs/vue3";
import Header from "@/Components/Header.vue";
import Error from "@/Components/Error.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const cars = computed(() => usePage().props.cars);

function routeToPostCar(){
    router.visit("/car/post")
}
</script>

<template>
    <div class="w-full flex flex-col justify-center items-center space-y-8">
        <div class="flex w-10/12 px-10 pr-20 items-center justify-between">
            <Header v-if="cars.data.length" class="" title="Your Posts" subtitle="List of Cars You Posted"/>
            <PrimaryButton @click="routeToPostCar" class="w-32 py-2.5 h-fit">Post Car</PrimaryButton>
        </div>
        <div v-if="cars.data.length" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <Items is-editable v-for="car in cars.data" :car="car"
                   :seller-type="i % 2 === 0 ? 'Private Seller':'Broker'"/>
        </div>
        <Error v-else error="No cars found" class="mt-40 md:mt-72"/>
        <Pagination class="mx-auto" :links="cars.links"/>
    </div>
</template>

<style scoped>

</style>
