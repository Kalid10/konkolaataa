<script setup>

import Header from "@/Components/Header.vue";
import Items from "@/Views/Cars/Item.vue";
import DesktopFilter from "@/Views/Filters/DesktopFilters.vue";
import UsedCarFilters from "@/Views/Cars/UsedCarFilters.vue";
import NewCarFilters from "@/Views/Cars/NewCarFilters.vue";
import FilterDrawer from "@/Views/Filters/FilterDrawer.vue";
</script>

<template>
    <div class="flex flex-col space-y-6 md:space-y-3">
        <Header title="Cars" subtitle="List of Cars" />
        <FilterDrawer/>
        <div class="w-full flex  justify-center md:space-x-12 md:justify-between">
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
            <div class="w-full items-center md:items-start md:w-9/12 flex flex-col md:flex-row space-y-4 md:space-y-0 md:flex-wrap md:justify-between">
                <Items v-for="i in 21" :seller-type="i % 2 === 0 ? 'Private Seller':'Broker'" />
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
