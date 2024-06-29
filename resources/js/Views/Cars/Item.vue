<script setup>
import {Gauge, Eye, Share} from "lucide-vue-next";
</script>

<template>
    <div class="w-full max-w-lg rounded-lg flex flex-col shadow-md bg-gray-50">
        <img class="object-cover h-40 rounded-t-lg" src="../../../../public/assets/images/pl.jpg">
        <div class="flex flex-col space-y-2.5 px-3 py-3 text-xs">
            <div class="flex w-full justify-between">
                <div class="">Used Suzuki Dzire </div>
                <div class="text-xs">2022</div>
            </div>

            <div class="flex justify-between">
                <div class="font-semibold text-lg border border-gray-600 px-1 rounded-md">3,100,000 Br</div>
                <div class="flex items-center space-x-1 text-xs">
                    <Gauge size="16"/>
                    <div>20k (KM)</div>
                </div>
            </div>

            <div class="flex w-full justify-between items-center text-xs">
                <div class="flex space-x-1 items-center">
                    <div class="h-3 w-3 rounded-full bg-gray-500"></div>
                    <div class="">Gray</div>
                </div>
                <div class="">Semi-Automatic</div>
            </div>

            <div class="border-t flex justify-between pt-3 items-center text-xs">
                <div class="flex space-x-1 items-center">
                    <Share size="14"/>
                    <div class="">Share</div>
                </div>
                <div class="flex space-x-1 items-center bg-stone-800 px-2 py-1 rounded-lg text-white">
                    <Eye size="14"/>
                    <div>Quick View</div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
