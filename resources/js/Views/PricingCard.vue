<script setup>
import { defineProps } from 'vue';
import { CheckCircle } from 'lucide-vue-next';
import PrimaryButton from "@/Components/PrimaryButton.vue";

const props = defineProps({
    tier: Object
});
</script>
<template>
    <div :class="['relative flex flex-col space-y-3 border-4 rounded-lg px-10 py-8 shadow-md w-full md:w-[27%]', tier.borderColor, tier.textColor, tier.bgColor]">
        <div :class="['absolute top-3 right-4 text-xs font-light px-2 py-0.5 w-fit rounded-sm', tier.tagColor, tier.textColor]">{{ tier.name }}</div>
        <div class="font-medium text-3xl">{{ tier.planName }}</div>
        <div class="font-light text-sm">{{ tier.description }}</div>
        <div class="flex items-end space-x-2">
            <div class="font-semibold text-5xl">{{ tier.price }}</div>
            <div class="font-medium text-sm">{{ tier.priceValue }}</div>
        </div>
        <div class="flex flex-col space-y-5 text-sm font-light pt-4">
            <PrimaryButton :class="['w-fit', tier.buttonColor]">Get Started</PrimaryButton>
            <div class="font-light text-sm pl-1">Features</div>
            <div v-for="feature in tier.features" :key="feature" class="flex items-center space-x-2">
                <CheckCircle size="20" :class="tier.iconColor"/>
                <span>{{ feature }}</span>
            </div>
        </div>
    </div>
</template>
