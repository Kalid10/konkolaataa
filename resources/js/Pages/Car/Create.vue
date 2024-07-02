<script setup>

import {computed, ref} from "vue";
import StepOne from "@/Views/Car/Create/Steps/StepOne.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import StepTwo from "@/Views/Car/Create/Steps/StepTwo.vue";
import StepThree from "@/Views/Car/Create/Steps/StepThree.vue";
import StepFour from "@/Views/Car/Create/Steps/StepFour.vue";
import StepFive from "@/Views/Car/Create/Steps/StepFive.vue";

const currentStep = ref(4);
const stepLabels = [
    'General Information',
    'Car Details',
    'Pricing & Location',
    'Upload Car Images',
    'Finalize Posting Car'
]
</script>

<template>
    <div class="flex flex-col space-y-6 md:space-y-8 py-3 max-w-lg mx-auto">

        <!--        <Header title="Post Car" />-->
        <div class="flex flex-col w-full space-y-4">
            <div class="flex space-x-2 items-center">
                <div class="bg-brand-primary text-white px-4 py-1 rounded-sm font-semibold text-xl">{{currentStep}}</div>
                <div class="text-lg font-medium">{{stepLabels[currentStep-1]}}</div>
            </div>

            <div  class="flex">
                <span v-for="i in 5" :class="['w-1/4 h-1.5 first:rounded-l-xl last:rounded-r-xl', i <= currentStep ? 'bg-brand-primary' : 'bg-indigo-100', i === currentStep ?'rounded-r-lg': '']"></span>
            </div>
            <div class="text-sm">
                Step {{currentStep}} of 5
            </div>
        </div>

        <StepOne v-if="currentStep === 1"/>
        <StepTwo v-if="currentStep === 2"/>
        <StepThree v-if="currentStep === 3"/>
        <StepFour v-if="currentStep === 4"/>
        <StepFive v-if="currentStep === 5"/>

        <div class="flex justify-between">
            <PrimaryButton :disabled="currentStep === 1" :class="currentStep === 1 ? 'opacity-60' :'opacity-100'" @click="currentStep--">Previous Step</PrimaryButton>
            <PrimaryButton :disabled="currentStep === 5" :class="currentStep === 5 ? 'opacity-60' :'opacity-100'" @click="currentStep++">Next Step</PrimaryButton>
        </div>
    </div>
</template>

<style scoped>

</style>
