<script setup>

import {Facebook, MapPin, Send} from "lucide-vue-next";
</script>

<template>
    <div class="flex flex-col w-full md:text-lg h-fit space-y-2 md:space-y-4 bg-brand-primary p-3 md:p-5 rounded-lg text-white">
        <div class="text-2xl md:text-4xl font-bold w-fit">Bereket Gobeze</div>
        <div class="font-medium">0921618103</div>
        <div class="text-sm md:text-base font-medium">Broker X 2% = 25,890Br</div>
        <div class="hidden md:flex  justify-between">
            <div class="font-medium">Addis Ababa</div>
            <div class="flex space-x-3 md:space-x-10">
                <MapPin/>
                <Send/>
                <Facebook/>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
