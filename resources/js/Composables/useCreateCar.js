import { computed } from "vue";
import { useStorage } from "@vueuse/core";
import { router, usePage } from "@inertiajs/vue3";

export function useCreateCar() {
    const initialData = (car) => ({
        stepOne: {
            carBrandId: car ? car.car_model.car_brand_id : null,
            description: car ? car.description : null,
            year: car ? String(car.year) : null,
            carModelId: car ? car.car_model_id : null,
        },
        stepTwo: {
            carConditionTypeId: car ? car.car_condition_type_id : null,
            carBodyTypeId: car ? car.car_body_type_id : null,
            transmissionType: car ? car.transmission_type : null,
            fuelTypeId: car ? car.fuel_type_id : null,
            engineTypeId: car ? car.engine_type_id : null,
            mileage: 0,
            electricCarRange: car ? car.electric_car_range : null,
            isDoubleCab: car ? car.is_double_cab : 0,
        },
        stepThree: {
            numberOfSeats: car ? car.number_of_seats : null,
            exteriorColorId: car ? car.exterior_color_id : null,
            interiorColorId: car ? car.interior_color_id : null,
            isOriginalPaint: car ? car.is_original_paint : 1,
            isAccidentFree: car ? car.accident_severity === 'none' ? 1 : 0 : 1,
            severityOfAccident: car ? car.accident_severity : 'none',
            motorStatus: car ? car.motor_status : null,
        },
        stepFour: {
            price: car ? car.price : null,
            priceType: car ? car.price_type : null,
            cityId: car ? car.city_id : null,
            location: car ? car.location : null,
            googleMapLink: car ? car.google_map_link : null,
        },
        stepFive: {
            exteriorImages: [],
            exteriorImagesPreview: [],
            interiorImages: [],
            interiorImagesPreview: [],
        },
        stepSix: {
            sellerType: car ? car.seller_type : null,
            percentage: car ? car.percentage : null,
            phoneNumber: car ? car.phone_number : null,
            isBankDebtFree: car ? car.is_bank_debt_free : 1,
            bankDebtAmount: car ? car.bank_debt_amount : null,
            carPlateType: car ? car.plate_type : null,
            hasClearance: car ? car.has_clearance : null,

        },
        finalizePosting: {},
        currentStep: 1,
        carId: car ? car.id : null,
        user_id: computed(() => usePage().props.auth.user.id),
    });

    const carFormData = useStorage('carFormData', initialData());

    const updateCurrentStep = (step) => {
        carFormData.value.currentStep = step;
    }

    const clearData = () => {
        carFormData.value = initialData();
    };

    return {
        carFormData,
        updateCurrentStep,
        clearData,
        initialData
    };
}
