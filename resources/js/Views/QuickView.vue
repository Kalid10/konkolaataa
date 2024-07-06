<script setup>
import {
    Sheet,
    SheetContent,
    SheetDescription,
    SheetHeader,
    SheetTrigger,
} from '@/Components/shadcn/ui/sheet/index.js'
import {Antenna, Car, Cog, Eye, Fuel, Gauge, RectangleHorizontal, ShieldBan} from "lucide-vue-next";
import {useUtilities} from "@/Composables/useUtilities.js";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {router} from "@inertiajs/vue3";

defineProps({
    car: {
        type: Object,
        required: true
    },
});
function stopPropagation(event) {
    event.stopPropagation()
}

const utilities = useUtilities()
const routeToItem = (id) => {
    router.visit(`/car/show/${id}`);
}
</script>

<template>
    <Sheet class="!w-full">
        <SheetTrigger @click="stopPropagation">
            <div class="pl-3 hover:scale-110 cursor-pointer">
                <Eye class="w-4" />
            </div>
        </SheetTrigger>
        <SheetContent class="!overflow-y-auto">
            <SheetHeader >
                <SheetDescription >
                    <div class="flex flex-col space-y-4 md:space-y-10">
                        <div class="flex justify-between space-x-10 ">
                            <div class="w-full flex flex-col space-y-4 justify-evenly">
                                <img src="../../../public/assets/images/pl.jpg" class="rounded-lg h-40 md:h-52 w-full object-cover">
                                <div class="flex items-center space-x-5 min-w-full overflow-x-auto hide-scrollbar">
                                    <img v-for="i in 5" src="../../../public/assets/images/pl.jpg" :class="i === 1 ? '':'opacity-50'" class=" cursor-pointer rounded-lg h-20 min-w-28 object-cover">
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-col w-full justify-between text-black">

                            <div class="flex flex-col space-y-4 w-full bg-gray-50 px-5 py-2 rounded-lg">
                                <div class="text-3xl  font-semibold">{{car.car_model.car_brand.name}} {{car.car_model.name}} </div>
                                <div class="flex flex-col w-full space-y-1">
                                    <div class="text-xl md:text-2xl border border-gray-600  font-medium rounded-lg w-fit p-2">{{utilities.formatNumberWithCommas(car.price)}} Br</div>
                                    <div class="text-sm md:font-medium p-1 uppercase">{{car.price_type}}</div>
                                </div>

                                <div class="pt-1 font-semibold text-xl md:text-3xl">Overview</div>

                                <div class="flex flex-col space-y-6 md:space-y-0 w-full md:justify-between py-2 ">
                                    <div class="flex flex-col space-y-6 md:justify-evenly">
                                        <div class="flex space-x-3 items-center font-medium uppercase">
                                            <Antenna class="text-brand-primary"  size="15"/>
                                            <div>{{car.car_condition_type.name}}</div>
                                        </div>
                                        <div class="flex space-x-3 items-center font-medium uppercase">
                                            <Antenna class="text-brand-primary"  size="15"/>
                                            <div>{{ car.transmission_type }}</div>
                                        </div>
                                        <div class="flex space-x-3 items-center font-medium">
                                            <Gauge class="text-brand-primary"  size="16"/>
                                            <div>Mileage: {{car.mileage}} Km</div>
                                        </div>
                                        <div class="flex space-x-3 items-center font-medium">
                                            <Cog class="text-brand-primary"  size="16"/>
                                            <div>Engine: {{car.engine_type.name}}</div>
                                        </div>
                                        <div class="flex space-x-3 items-center font-medium capitalize">
                                            <Fuel class="text-brand-primary" size="16"/>
                                            <div>Fuel Type: {{ car.fuel_type.name }}</div>
                                        </div>

                                        <div class="flex space-x-3 items-center font-medium capitalize">
                                            <Car class="text-brand-primary" size="16"/>
                                            <div>Body Type: {{ car.car_body_type.name }}</div>
                                        </div>
                                    </div>
                                    <div class="hidden md:flex min-h-full w-0.5 bg-gray-300"></div>
                                    <div class="flex flex-col space-y-6 pt-6">
                                        <div class="flex space-x-3 items-center font-medium">
                                            <div class="w-3 h-3 rounded-full border border-gray-400" :style="'background-color:' + car.exterior_color.hex"></div>
                                            <div>Exterior Color: {{ car.exterior_color.name }}</div>
                                        </div>
                                        <div class="flex space-x-3 items-center font-medium">
                                            <div class="w-3 h-3 rounded-full border border-gray-400" :style="'background-color:' + car.interior_color.hex"></div>
                                            <div>Interior Color: {{ car.interior_color.name }}</div>
                                        </div>

                                        <div class="flex space-x-3 items-center font-medium capitalize">
                                            <RectangleHorizontal class="text-brand-primary" size="16"/>
                                            <div>Plate Type: {{ car.plate_type }}</div>
                                        </div>

                                        <div class="flex space-x-3 items-center font-medium capitalize">
                                            <ShieldBan class="text-brand-primary" size="16"/>
                                            <div>Accident: {{ car.accident_severity }}</div>
                                        </div>


                                        <div class="py-2 px-4 rounded-lg flex flex-col space-y-2 border border-black text-sm capitalize">
                                            <div class="flex items-center justify-between">
                                                <span class="font-medium">{{car.user.name}}</span>
                                                <span>{{car.seller_type}}</span>
                                            </div>
                                            <div class="flex items-center justify-between">
                                                <span>{{car.phone_number}}</span>
                                                <span>{{ car.city.name }}, {{ car.location }}</span>
                                            </div>
                                        </div>

                                        <PrimaryButton @click="routeToItem(car.id)">View Full Details</PrimaryButton>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </SheetDescription>
            </SheetHeader>
        </SheetContent>
    </Sheet>
</template>
