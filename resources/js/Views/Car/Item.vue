<script setup>
import {MapPin, Edit, Eye} from "lucide-vue-next";
import moment from "moment";
import {useUtilities} from "@/Composables/useUtilities.js";
import QuickView from "@/Views/QuickView.vue";
import {useCreateCar} from "@/Composables/useCreateCar.js";
import {router} from "@inertiajs/vue3";
import Tags from "@/Components/Tags.vue";

const props = defineProps({
    car: {
        type: Object,
        required: true
    },
    isEditable: {
        type: Boolean,
        default: false
    }
})

const utilities = useUtilities()

const {initialData, carFormData} = useCreateCar();

function editCar(car) {
    carFormData.value = initialData(car); // Update the storage with the existing car data
    router.visit('/car/post', {
        preserveState: true,
        preserveScroll: true
    });
}
</script>

<template>
    <div class="pb-4 mr-8 flex justify-center w-full md:w-fit cursor-pointer">
        <div
            class=" min-w-[20rem] w-fit max-w-[22rem] rounded-lg flex flex-col shadow-sm hover:shadow-2xl bg-gray-50 h-fit">
            <img class="object-cover h-40 w-full rounded-t-lg" :src="car.images[0].url">
            <div class="flex flex-col space-y-2.5 px-3 py-3 text-xs">
                <div class="flex text-base w-full items-center justify-between">
                    <div class="font-medium text-sm">{{ car.car_model.car_brand.name }} {{ car.car_model.name }}</div>
                    <div
                        :class="car.car_condition_type.name === 'brand_new' ? 'bg-emerald-400 text-black' : car.car_condition_type.name === 'used' ? 'bg-brand-primary text-white' : 'bg-rose-500 text-white'"
                        class="uppercase px-2 py-1 bg-brand-primary text-xs rounded-md">
                        {{ utilities.removeUnderscores(car.car_condition_type.name) }}
                    </div>
                </div>

                <div class="flex justify-between">
                    <div class="font-bold text-xl">
                        {{ utilities.formatNumberWithCommas(car.price) }} Br
                    </div>
                    <div class="flex items-center space-x-1 text-xs">
                        <MapPin size="12"/>
                        <div>{{ car.city.name }}</div>
                    </div>
                </div>


                <div class="flex flex-wrap">

                    <Tags :tag="car.year" />
                    <Tags :tag="utilities.formatNumberWithCommas(car.mileage) +' Km'" />
                    <Tags :tag="car.fuel_type.name" />
                    <Tags class="flex space-x-2 items-center text-xs" :tag="car.seller_type" />
                </div>


            <div class="border-t flex justify-between pt-3 items-center text-xs">
                <div class="capitalize">
                    {{ moment(car.posted_at).fromNow() }}
                </div>

                <div @click="() => editCar(car)" v-if="isEditable"
                     class="flex space-x-1.5 items-center bg-brand-primary text-white px-3 rounded-md shadow-sm font-medium">
                    <Edit class="w-3"/>
                    <span>Edit</span>
                </div>

                <div v-else class="flex items-center space-x-1">
                     <QuickView :car="car" @click.prevent/>
                </div>
            </div>
        </div>
    </div>
    </div>
</template>
