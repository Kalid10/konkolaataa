<script setup>
import {ref, computed, watch} from "vue";
import StepOne from "@/Views/Car/Create/Steps/StepOne.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import StepTwo from "@/Views/Car/Create/Steps/StepTwo.vue";
import StepThree from "@/Views/Car/Create/Steps/StepThree.vue";
import StepFour from "@/Views/Car/Create/Steps/StepFour.vue";
import {useCreateCar} from "@/Composables/useCreateCar.js";
import StepFive from "@/Views/Car/Create/Steps/StepFive.vue";
import StepSix from "@/Views/Car/Create/Steps/StepSix.vue";

const { carFormData, updateCurrentStep } = useCreateCar();
const currentStep = ref(carFormData.value.currentStep ?? 1);
const stepLabels = [
    'General Information',
    'Car Details',
    'Accidents & Paint Details',
    'Pricing & Location',
    'Personal Information',
    'Upload Car Images',
];

const prevStep = () => {
    if (currentStep.value > 1) currentStep.value--;
};

const nextStep = () => {
    if (currentStep.value < 6) currentStep.value++;
};

watch(() => currentStep.value, (newVal) => {
    updateCurrentStep(newVal);
});

const showNextButton = ref(false);
watch(() => carFormData.value, (newVal) => {
    if (currentStep.value === 1) {
        showNextButton.value = newVal.stepOne.carBrandId && newVal.stepOne.carModelId && newVal.stepOne.year && newVal.stepOne.carPlateType;
    } else if (currentStep.value === 2) {
        showNextButton.value = newVal.stepTwo.carConditionTypeId && newVal.stepTwo.carBodyTypeId && newVal.stepTwo.transmissionType && newVal.stepTwo.fuelTypeId && newVal.stepTwo.engineTypeId;
    } else if (currentStep.value === 3) {
        showNextButton.value = newVal.stepThree.exteriorColorId && newVal.stepThree.interiorColorId && newVal.stepThree.isOriginalPaint && newVal.stepThree.isAccidentFree;
    } else if (currentStep.value === 4) {
        showNextButton.value = newVal.stepFour.priceType && newVal.stepFour.price && newVal.stepFour.cityId;
    } else if (currentStep.value === 5) {
        showNextButton.value = newVal.stepSix.sellerType && newVal.stepSix.percentage && newVal.stepSix.phoneNumber;
    }
}, {deep: true, immediate: true});
</script>

<template>
    <div class="flex flex-col space-y-6 md:space-y-8 py-3 max-w-lg mx-auto">
        <div class="flex flex-col w-full space-y-4">
            <div class="flex space-x-2 items-center">
                <div class="bg-brand-primary text-white px-4 py-1 rounded-sm font-semibold text-xl">{{ currentStep }}</div>
                <div class="text-lg font-medium">{{ stepLabels[currentStep - 1] }}</div>
            </div>

            <div class="flex">
                <span v-for="i in 6" :key="i" :class="['w-1/4 h-1.5 first:rounded-l-xl last:rounded-r-xl', i <= currentStep ? 'bg-brand-primary' : 'bg-indigo-100', i === currentStep ? 'rounded-r-lg' : '']"></span>
            </div>
            <div class="text-sm">
                Step {{ currentStep }} of 6
            </div>
        </div>

        <StepOne v-if="currentStep === 1" v-model="carFormData.stepOne" />
        <StepTwo v-if="currentStep === 2" v-model="carFormData.stepTwo" />
        <StepThree v-if="currentStep === 3" v-model="carFormData.stepThree" />
        <StepFour v-if="currentStep === 4" v-model="carFormData.stepFour" />
        <StepFive v-if="currentStep === 5" v-model="carFormData.stepSix" />
        <StepSix  v-if="currentStep === 6"  />


        <div class="flex justify-between" >
            <PrimaryButton :disabled="currentStep === 1" :class="currentStep === 1 ? 'opacity-60' : 'opacity-100'" @click="prevStep">Previous Step</PrimaryButton>
            <PrimaryButton :disabled="currentStep === 6 || !showNextButton" :class="currentStep === 6 || !showNextButton? 'opacity-60' : 'opacity-100'" @click="nextStep">Next Step</PrimaryButton>
        </div>
    </div>
</template>

<style scoped>
/* Add any additional styles here */
</style>
