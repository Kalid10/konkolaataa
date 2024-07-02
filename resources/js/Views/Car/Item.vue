<script setup>
import {Gauge} from "lucide-vue-next";

defineProps({
    sellerType: {
        type: String,
        default: "Private Seller"
    }
})
</script>

<template>
    <div class="pb-4 flex justify-center w-full md:w-fit">
    <div class=" w-full min-w-72 max-w-xs rounded-lg flex flex-col shadow-md bg-gray-50 h-fit">
        <img class="object-cover h-40 w-full rounded-t-lg" src="../../../../public/assets/images/pl.jpg">
        <div class="flex flex-col space-y-2.5 px-3 py-3 text-xs">
            <div class="flex w-full justify-between">
                <div class="">Used VW Polo </div>
                <div class="text-xs">2002</div>
            </div>

            <div class="flex justify-between">
                <div class="font-semibold text-lg border border-gray-600 px-1 rounded-md">940,000 Br</div>
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
                <div class="">
                    3 days ago
                </div>

                <div :class="sellerType ==='Broker' ? 'bg-red-600':'bg-blue-600'" class="px-2 py-1 text-white rounded-md">{{sellerType}}</div>
            </div>
        </div>
    </div>
    </div>
</template>
