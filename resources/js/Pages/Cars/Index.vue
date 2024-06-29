<script setup>

import Header from "@/Components/Header.vue";
import Items from "@/Views/Cars/Item.vue";
</script>

<template>
    <div class="flex flex-col space-y-4">
        <Header title="Cars" subtitle="List of Cars" />
        <div class="flex flex-col space-y-4">
            <Items v-for="i in 6" />
        </div>
    </div>
</template>

<style scoped>

</style>
