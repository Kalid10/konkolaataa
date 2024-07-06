<script setup>

import Items from "@/Views/Car/Item.vue";
import Pagination from "@/Components/Pagination.vue";
import {computed} from "vue";
import {usePage} from "@inertiajs/vue3";

const cars = computed(()=>usePage().props.cars);

</script>

<template>
    <div class="w-full h-fit items-center mx-auto md:items-start md:w-9/12 flex flex-col md:flex-row space-y-4 md:space-y-0 md:flex-wrap md:justify-between">
        <Items is-editable v-for="car in cars.data" :car="car" :seller-type="i % 2 === 0 ? 'Private Seller':'Broker'" />
        <Pagination :links="cars.links"/>
    </div>
</template>

<style scoped>

</style>
