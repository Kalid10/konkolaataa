import { useStorage } from '@vueuse/core';
import {router, usePage} from "@inertiajs/vue3";
import {computed} from "vue";

export function useCreateCar() {
    const carFormData = useStorage('carFormData', {
        stepOne: {
            carBrandId: null,
            description: null,
            year: null,
            carModelId: null,
            carPlateType: null,
        },
        stepTwo: {
            carConditionTypeId: null,
            carBodyTypeId: null,
            transmissionType: null,
            fuelTypeId: null,
            engineTypeId: null,
            mileage: 0,
        },
        stepThree: {
            exteriorColorId: null,
            interiorColorId: null,
            isOriginalPaint: true,
            isAccidentFree: 1,
            severityOfAccident: null,
        },
        stepFour: {

            price: null,
            priceType: null,
            cityId: null,
            location: null,
            googleMapLink: null,
        },
        stepFive: {
           images: []
        },
        stepSix: {
            sellerType: null,
            percentage: 2,
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

    function postCar(){
        // Merge all the carFormData into one object
        const carData = Object.assign({}, carFormData.value.stepOne, carFormData.value.stepTwo, carFormData.value.stepThree, carFormData.value.stepFour, carFormData.value.stepFive, carFormData.value.stepSix, carFormData.value.user_id);
        console.log(carData)
        router.post('/car/store', carData)
    }
    return {
        carFormData,
        updateGeneralInformation,
        updateCurrentStep,
        postCar

    };
}
