<script setup>
import {Gauge ,Edit, Eye} from "lucide-vue-next";
import moment from "moment";
import {useUtilities} from "@/Composables/useUtilities.js";
import QuickView from "@/Views/QuickView.vue";
import {useCreateCar} from "@/Composables/useCreateCar.js";
import {router} from "@inertiajs/vue3";

const props  = defineProps({
    car:{
        type:Object,
        required:true
    },
    isEditable:{
        type:Boolean,
        default:false
    }
})

const utilities = useUtilities()

const { initialData, carFormData } = useCreateCar();
function editCar(car) {
    carFormData.value = initialData(car); // Update the storage with the existing car data
    router.visit('/car/post', {
        preserveState: true,
        preserveScroll: true
    });
}
</script>

<template>
    <div class="pb-4 flex justify-center w-full md:w-fit cursor-pointer">
        <div class=" w-full min-w-72 max-w-xs rounded-lg flex flex-col shadow-md bg-gray-50 h-fit">
            <img class="object-cover h-40 w-full rounded-t-lg" src="../../../../public/assets/images/pl.jpg">
            <div class="flex flex-col space-y-2.5 px-3 py-3 text-xs">
                <div class="flex w-full justify-between">
                    <div class="">{{car.car_model.car_brand.name}} {{car.car_model.name}} </div>
                    <div class="text-xs">{{ car.year }}</div>
                </div>

                <div class="flex justify-between">
                    <div class="font-semibold text-lg border border-gray-600 px-1 rounded-md">{{ utilities.formatNumberWithCommas(car.price) }} Br</div>
                    <div class="flex items-center space-x-1 text-xs">
                        <Gauge size="16"/>
                        <div>{{ car.mileage }} (KM)</div>
                    </div>
                </div>

                <div class="flex w-full justify-between items-center text-xs">
                    <div class="flex space-x-1 items-center">
                        <div class="h-3 w-3 rounded-full" :style="'background-color:'+ car.exterior_color.hex"></div>
                        <div class="">{{ car.exterior_color.name }}</div>
                    </div>
                    <div
                        :class="car.car_condition_type.name === 'brand_new' ? 'bg-emerald-400 text-black' : car.car_condition_type.name === 'used' ? 'bg-brand-primary text-white' : 'bg-rose-500 text-white'"
                        class="uppercase px-2 py-1 bg-brand-primary  rounded-md">{{ utilities.removeUnderscores(car.car_condition_type.name)}}</div>
                </div>

                <div class="border-t flex justify-between pt-3 items-center text-xs">
                    <div class="capitalize">
                        {{ moment(car.posted_at).fromNow()}}
                    </div>

                    <div @click="() => editCar(car)" v-if="isEditable" class="flex space-x-1.5 items-center bg-brand-primary text-white px-3 rounded-md shadow-sm font-medium">
                        <Edit class="w-3"/>
                        <span>Edit</span>
                    </div>

                    <div v-else class="flex items-center space-x-1">

                        <div class="py-1 px-2 rounded-md uppercase flex items-center space-x-1">
                            <span>{{car.seller_type}}</span>
                            <span v-if="car.seller_type === 'broker'">({{car.percentage}}%)</span>
                        </div>
                        <QuickView :car="car" @click.prevent/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
