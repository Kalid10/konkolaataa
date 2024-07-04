<script setup>

import {Facebook, MapPin, Send} from "lucide-vue-next";
import {computed} from "vue";

const props = defineProps({
    car: {
        type: Object,
        required: true,
    },
})

// Calculate the broker fee
const brokerFee = computed(() => {
    if (props.car.seller_type === 'broker') {
        return props.car.price * props.car.percentage / 100;
    }
    return 0;
})
</script>

<template>
    <div class="flex flex-col w-full md:text-lg h-fit space-y-2 md:space-y-4 bg-brand-primary p-3 md:p-5 rounded-lg text-white">
        <div class="text-2xl md:text-4xl font-bold w-fit">{{car.user.name}}</div>
        <div class="font-medium">0921618103</div>
        <div v-if="car.seller_type === 'broker'" class="text-sm md:text-base font-medium capitalize">{{ car.seller_type }} X {{car.percentage}}% = {{brokerFee}} Br</div>
        <div v-else class="text-sm md:text-base font-medium"> {{car.seller_type}}</div>
        <div class="hidden md:flex  justify-between">
            <div class="font-medium">{{car.city.name}}, {{car.location}}</div>
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
