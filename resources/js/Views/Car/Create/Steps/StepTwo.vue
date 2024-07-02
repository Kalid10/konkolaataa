<script setup>

import {
    Select,
    SelectContent,
    SelectGroup,
    SelectItem,
    SelectTrigger,
    SelectValue
} from "@/Components/shadcn/ui/select/index.js";
import InputLabel from "@/Components/InputLabel.vue";
import {Textarea} from "@/Components/shadcn/ui/textarea/index.js";
import {Input} from "@/Components/shadcn/ui/input/index.js";

const transmissionTypes = [
    'Manual',
    'Automatic',
    'Semi-Automatic',
];

const fuelTypes = [
    'Petrol',
    'Diesel',
    'Electric',
    'Hybrid',
];

const engineSizes = [
    '1.0L',
    '1.2L',
    '1.4L',
    '1.6L',
    '1.8L',
    '2.0L',
    '2.2L',
    '2.4L',
    '2.6L',
    '2.8L',
    '3.0L',
    '3.2L',
    '3.4L',
    '3.6L',
    '3.8L',
    '4.0L',
    '4.2L',
    '4.4L',
    '4.6L',
    '4.8L',
    '5.0L',
    '5.2L',
    '5.4L',
    '5.6L',
    '5.8L',
    '6.0L',
    '6.2L',
    '6.4L',
    '6.6L',
    '6.8L',
    '7.0L',
    '7.2L',
    '7.4L',
    '7.6L',
    '7.8L',
    '8.0L',
    '8.2L',
    '8.4L',
    '8.6L',
    '8.8L',
    '9.0L',
    '9.2L',
    '9.4L',
    '9.6L',
    '9.8L',
    '10.0L',
];

const colors = [

    {name: 'Gray', value: '#808080'},
    {name: 'Orange', value: '#FFA500'},
    {name: 'Brown', value: '#A52A2A'},
    {name: 'Red', value: '#d60000'},
    {name: 'Purple', value: '#800080'},
    {name: 'Green', value: '#22c55e'},
    {name: 'Yellow', value: '#FFFF00'},
    {name: 'Black', value: '#000000'},
    {name: 'White', value: '#FFFFFF'},
    {name: 'Blue', value: '#2563eb'},
    {name: 'Pink', value: '#FFC0CB'},
    {name: 'Gold', value: '#FFD700'},
    {name: 'Silver', value: '#C0C0C0'},
    {name: 'Beige', value: '#F5F5DC'},
    {name: 'Maroon', value: '#800000'},
    {name: 'Turquoise', value: '#40E0D0'},
    {name: 'Lime', value: '#00FF00'},
    {name: 'Teal', value: '#008080'},
    {name: 'Navy', value: '#000080'},
    {name: 'Magenta', value: '#FF00FF'},
    {name: 'Olive', value: '#808000'},
    {name: 'Cyan', value: '#00FFFF'},
    {name: 'Aqua', value: '#00FFFF'},
    {name: 'Salmon', value: '#FA8072'},
    {name: 'Violet', value: '#EE82EE'},
    {name: 'Indigo', value: '#4B0082'},
    {name: 'Tan', value: '#D2B48C'},
    {name: 'Coral', value: '#FF7F50'},
    {name: 'Khaki', value: '#F0E68C'},
    {name: 'Crimson', value: '#DC143C'},
    {name: 'Lavender', value: '#E6E6FA'},
    {name: 'Plum', value: '#DDA0DD'},
    {name: 'Ivory', value: '#FFFFF0'},
    {name: 'Azure', value: '#F0FFFF'},
    {name: 'Mint', value: '#98FF98'},
    {name: 'Lavender', value: '#E6E6FA'},
    {name: 'Coral', value: '#FF7F50'},
    {name: 'Khaki', value: '#F0E68C'},
    {name: 'Crimson', value: '#DC143C'},
    {name: 'Lavender', value: '#E6E6FA'},
    {name: 'Plum', value: '#DDA0DD'},
    {name: 'Ivory', value: '#FFFFF0'}
]
const carCondition = [
    {name: 'Brand New', value: 1},
    {name: 'Not Used In Ethiopia', value: 2},
    {name: 'Used In Ethiopia', value: 3},
]

const bodyTypes = [
    'Sedan',
    'SUV',
    'Hatchback',
    'Coupe',
    'Convertible',
    'Wagon',
    'Van',
    'Truck',
    'Bus',
    'Mini Van',
    'Pickup',
    'Crossover',
    'Other',
]
</script>

<template>
    <div class="flex flex-col space-y-4">
        <div class="flex flex-col space-y-2">
            <InputLabel>What type of car are you selling?</InputLabel>
            <Select>
                <SelectTrigger>
                    <SelectValue placeholder="Select Car Condition" />
                </SelectTrigger>
                <SelectContent>
                    <SelectGroup>
                        <SelectItem v-for="item in carCondition" :value="item.value">
                            {{ item.name }}
                        </SelectItem>
                    </SelectGroup>
                </SelectContent>
            </Select>
        </div>

        <div class="flex flex-col space-y-2">
            <InputLabel>Mileage</InputLabel>
            <Input placeholder="Eg: 10,500"/>
        </div>


        <div class="flex flex-col space-y-2">
            <InputLabel>Body Type</InputLabel>
            <Select>
                <SelectTrigger>
                    <SelectValue placeholder="Select Body Type" />
                </SelectTrigger>
                <SelectContent>
                    <SelectGroup>
                        <SelectItem v-for="item in bodyTypes" :value="item">
                            {{ item }}
                        </SelectItem>
                    </SelectGroup>
                </SelectContent>
            </Select>
        </div>
        <div class="flex flex-col space-y-2">
            <InputLabel>Transmission Type</InputLabel>
            <Select>
                <SelectTrigger>
                    <SelectValue placeholder="Select Transmission Type" />
                </SelectTrigger>
                <SelectContent>
                    <SelectGroup>
                        <SelectItem v-for="item in transmissionTypes" :value="item">
                            {{ item }}
                        </SelectItem>
                    </SelectGroup>
                </SelectContent>
            </Select>
        </div>

        <div class="flex flex-col space-y-2">
            <InputLabel>Fuel Type</InputLabel>
            <Select>
                <SelectTrigger>
                    <SelectValue placeholder="Select Fuel Type" />
                </SelectTrigger>
                <SelectContent>
                    <SelectGroup>
                        <SelectItem v-for="item in fuelTypes" :value="item">
                            {{ item }}
                        </SelectItem>
                    </SelectGroup>
                </SelectContent>
            </Select>
        </div>

        <div class="flex flex-col space-y-2">
            <InputLabel>Color</InputLabel>
            <Select>
                <SelectTrigger>
                    <SelectValue placeholder="Select Color" />
                </SelectTrigger>
                <SelectContent>
                    <SelectGroup>
                        <SelectItem  v-for="item in colors" :value="item.value">
                            <div class="!flex space-x-2 items-center">

                           <div class="w-3 h-3 rounded-full border border-gray-200" :style="'background-color:'+ item.value"></div>
                           <div>  {{ item.name }} </div>
                            </div>
                        </SelectItem>
                    </SelectGroup>
                </SelectContent>
            </Select>
        </div>

        <div class="flex flex-col space-y-2">
            <InputLabel>Engine Size</InputLabel>
            <Select>
                <SelectTrigger>
                    <SelectValue placeholder="Select Engine Size" />
                </SelectTrigger>
                <SelectContent>
                    <SelectGroup>
                        <SelectItem v-for="item in engineSizes" :value="item">
                            {{ item }}
                        </SelectItem>
                    </SelectGroup>
                </SelectContent>
            </Select>
        </div>
    </div>
</template>

<style scoped>

</style>
