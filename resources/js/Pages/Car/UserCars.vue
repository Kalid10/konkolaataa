<script setup>

import Items from "@/Views/Car/Item.vue";
import Pagination from "@/Components/Pagination.vue";
import {computed} from "vue";
import {usePage} from "@inertiajs/vue3";
import Header from "@/Components/Header.vue";
import Error from "@/Components/Error.vue";

const cars = computed(()=>usePage().props.cars);

</script>

<template>
    <div class="w-full flex flex-col justify-center items-center space-y-8">
        <Header v-if="cars.data.length" class="w-full pl-5" title="Your Posts" subtitle="List of Cars You Posted" />
        <div v-if="cars.data.length" class="w-full h-fit items-center  md:items-start flex flex-col md:flex-row space-y-4 md:space-y-0 md:flex-wrap ">
            <Items is-editable v-for="car in cars.data" :car="car" :seller-type="i % 2 === 0 ? 'Private Seller':'Broker'" />
            <Pagination :links="cars.links"/>
        </div>
        <Error v-else error="No cars found" class="mt-40 md:mt-72"/>
    </div>
</template>

<style scoped>

</style>
