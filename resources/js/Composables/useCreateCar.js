import { useStorage } from '@vueuse/core';
import {usePage} from "@inertiajs/vue3";
import {computed} from "vue";

export function useCreateCar() {
    const carFormData = useStorage('carFormData', {
        generalInformation: {
            carBrandId: null,
            description: null,
            carCondition: null,
            year: null,
            carModelId: null,
            carPlateType: null,
        },
        carDetails: {
            carConditionTypeId: null,
            carBodyTypeId: null,
            transmissionType: null,
            fuelTypeId: null,
            exteriorColorId: null,
            interiorColorId: null,
            mileage: null,
        },
        pricingLocation: {
            price: null,
            priceType: null,
            cityId: null,
            googleMapLink: null,
        },
        carImages: [],
        finalizePosting: {},
        currentStep: null,
        user_id: computed(() => usePage().props.auth.user.id),
    });

    const updateGeneralInformation = (data) => {
        carFormData.value.generalInformation = data;
    };

    const updateCarDetails = (data) => {
        carFormData.value.carDetails = data;
    }

    const updatePricingLocation = (data) => {
        carFormData.value.pricingLocation = data;
    }

    const updateCurrentStep = (step) => {
        carFormData.value.currentStep = step;
    }
    return {
        carFormData,
        updateGeneralInformation,
        updateCurrentStep,

    };
}
