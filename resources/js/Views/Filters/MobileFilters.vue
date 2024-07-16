<script setup>

import Tag from "@/Components/Tag.vue";
import FilterDrawer from "@/Views/Filters/FilterDrawer.vue";
import {ref} from "vue";

const emit = defineEmits(['selected'])
const openDrawer = ref(false);

</script>

<template>
    <div class=" hide-scrollbar flex md:hidden w-full space-x-5 overflow-x-auto">
        <Tag value="Condition" @click="emit('selected', 'condition')"/>
        <Tag value="Price" @click="emit('selected', 'price')"/>
        <Tag value="Year" @click="emit('selected', 'year')"/>
        <Tag value="Mileage" @click="emit('selected', 'mileage')"/>
        <Tag value="Seller Type" @click="emit('selected', 'seller_type')"/>
        <Tag value="Transmission" @click="emit('selected', 'transmission')"/>
        <Tag value="Color" @click="emit('selected', 'color')"/>
        <Tag value="Location" @click="emit('selected', 'location')"/>
    </div>
</template>

<style scoped>

</style>
