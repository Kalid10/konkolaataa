import { computed } from "vue";
import { useStorage } from "@vueuse/core";
import { router, usePage } from "@inertiajs/vue3";

export function useCreateCar() {
    const initialData = () => ({
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
            isAccidentFree: 0,
            severityOfAccident: 'none',
        },
        stepFour: {
            price: null,
            priceType: null,
            cityId: null,
            location: null,
            googleMapLink: null,
        },
        stepFive: {
            exteriorImages: [],
            exteriorImagesPreview: [],
            interiorImages: [],
            interiorImagesPreview: [],
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

    const carFormData = useStorage('carFormData', initialData());

    const updateCurrentStep = (step) => {
        carFormData.value.currentStep = step;
    }

    const clearData = () => {
        carFormData.value = initialData();
    };

    function postCar(exteriorImages, interiorImages) {

    }

    return {
        carFormData,
        updateCurrentStep,
        postCar,
    };
}
