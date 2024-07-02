<script setup>
import { Antenna, Fuel, MapPin,Facebook, Instagram, MessageSquareText, Send, Cog, Gauge, Car, Paperclip} from "lucide-vue-next";
import InputLabel from "@/Components/InputLabel.vue";
import SellerInfo from "@/Views/Car/Show/SellerInfo.vue";
import ShareItem from "@/Views/Car/Show/ShareItem.vue";
</script>

<template>
    <div class="flex flex-col space-y-4 md:space-y-10">
        <div class="flex justify-between space-x-10 ">
            <div class="w-full md:w-6/12 flex flex-col space-y-4 justify-evenly">
                <img src="../../../../public/assets/images/pl.jpg" class="rounded-lg h-56 md:h-[22rem] w-full object-cover">
                <div class="flex items-center space-x-5 min-w-full overflow-x-auto hide-scrollbar">
                    <img v-for="i in 5" src="../../../../public/assets/images/pl.jpg" :class="i === 1 ? '':'opacity-50'" class=" cursor-pointer rounded-lg h-20 min-w-28 object-cover">
                </div>
            </div>
            <div class="flex w-6/12 min-h-full space-x-6 justify-between">
                <div class="flex flex-col w-5/12 justify-between">
                    <img src="../../../../public/assets/images/pl.jpg" class="rounded-lg h-52 w-full object-cover">
                    <img src="../../../../public/assets/images/pl.jpg" class="rounded-lg h-52 w-full object-cover">
                </div>
                <img src="../../../../public/assets/images/pl.jpg" class="rounded-lg h-full md:w-7/12 object-cover">
            </div>
        </div>

        <div class="flex flex-col md:flex-row w-full justify-between">
        <div class="flex flex-col space-y-4 md:space-y-6 w-full md:bg-gray-50 md:px-5 md:pb-10 pt-5 rounded-lg md:w-6/12">
            <div class="flex justify-between items-center">
                <div class="text-3xl md:text-4xl font-semibold">Volkswagen Polo 2002</div>
            </div>
            <div class="flex justify-between md:items-end md:space-x-6 items-center">
                <div class="text-xl md:text-2xl font-light border border-gray-600 px-2.5 py-0.5 rounded-lg w-fit md:bg-brand-primary md:text-white md:font-medium">940,000 Br</div>
                <div class="text-sm md:font-medium md:text-base py-1 ">Slightly Negotiable</div>
            </div>

            <SellerInfo class="md:hidden"/>

            <div class="pt-3 font-semibold text-xl md:text-3xl">Overview</div>

            <div class="flex flex-col space-y-6 md:space-y-0 md:flex-row w-full md:justify-between py-2 md:text-lg">
                <div class="flex flex-col space-y-6 md:w-5/12 md:justify-evenly">
                    <div class="flex space-x-3 items-center font-medium">
                        <Antenna class="text-brand-primary"  size="15"/>
                        <div>Used In Ethiopia</div>
                    </div>
                    <div class="flex space-x-3 items-center font-medium">
                        <Antenna class="text-brand-primary"  size="15"/>
                        <div>Automatic Transmission</div>
                    </div>
                    <div class="flex space-x-3 items-center font-medium">
                        <Gauge class="text-brand-primary"  size="16"/>
                        <div>Mileage: 16,000 Km</div>
                    </div>
                    <div class="flex space-x-3 items-center font-medium">
                        <Cog class="text-brand-primary"  size="16"/>
                        <div>Engine: 1.6 L</div>
                    </div>
                </div>
                <div class="hidden md:flex min-h-full w-0.5 bg-gray-300"></div>
                <div class="flex flex-col space-y-6 md:w-5/12 md:justify-evenly">
                    <div class="flex space-x-3 items-center font-medium">
                        <div class="w-3 h-3 rounded-full bg-gray-800"></div>
                        <div>Exterior Color: Gray</div>
                    </div>
                    <div class="flex space-x-3 items-center font-medium">
                        <div class="w-3 h-3 rounded-full bg-gray-300"></div>
                        <div>Interior Color: Light Gray</div>
                    </div>
                    <div class="flex space-x-3 items-center font-medium">
                        <Fuel class="text-brand-primary" size="16"/>
                        <div>Fuel Type: Diesel</div>
                    </div>

                    <div class="flex space-x-3 items-center font-medium">
                        <Car class="text-brand-primary" size="16"/>
                        <div>Body Type: SUV</div>
                    </div>

                </div>
            </div>
            <ShareItem class="md:hidden"/>
        </div>
        <div class="hidden md:flex md:flex-col items-center justify-evenly w-5/12">
            <SellerInfo/>
            <ShareItem/>
        </div>
        </div>
    </div>
</template>

<style scoped>

</style>
