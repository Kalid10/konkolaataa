<script setup>

import InputLabel from "@/Components/InputLabel.vue";
import {Input} from "@/Components/shadcn/ui/input/index.js";
import {
    Select,
    SelectContent,
    SelectGroup,
    SelectItem,
    SelectTrigger,
    SelectValue
} from "@/Components/shadcn/ui/select/index.js";

const pricingOptions = [
    {name: 'Fixed Price', value: 'fixed'},
    {name: 'Negotiable', value: 'negotiable'},
    {name: 'Slightly Negotiable', value: 'slightly_negotiable'},
];

const cities = [
    'AddisAbaba',
    'DireDawa',
    'Mekelle',
    'Gondar',
    'Adama',
    'Hawassa',
    'Jimma',
    'BahirDar',
    'Dessie',
    'Jijiga',
    'Shashamane',
    'Dilla',
    'Sodo',
    'Nekemte',
    'Asosa',
    'Harar',
    'Gambela',
    'Gurage',
    'Wolaita',
    'Wollega',
    'Sidama',
    'Kaffa',
    'Gedeo',
]
</script>

<template>
    <div class="flex flex-col space-y-4 py-2">

        <div class="flex flex-col space-y-2">
            <InputLabel>Price Type</InputLabel>
            <Select>
                <SelectTrigger>
                    <SelectValue placeholder="Select Price Type" />
                </SelectTrigger>
                <SelectContent>
                    <SelectGroup>
                        <SelectItem v-for="item in pricingOptions" :value="item.value">
                            {{ item.name }}
                        </SelectItem>
                    </SelectGroup>
                </SelectContent>
            </Select>
        </div>

        <div class="flex flex-col space-y-2">
            <InputLabel>Price</InputLabel>
            <Input placeholder="Eg: 5,000,000"/>
        </div>

        <div class="flex flex-col space-y-2">
            <InputLabel>Select Cities</InputLabel>
            <Select multiple>
                <SelectTrigger>
                    <SelectValue placeholder="Select Cities" />
                </SelectTrigger>
                <SelectContent>
                    <SelectGroup>
                        <SelectItem v-for="item in cities" :value="item">
                            {{ item }}
                        </SelectItem>
                    </SelectGroup>
                </SelectContent>
            </Select>
        </div>

        <div class="flex flex-col space-y-2">
            <InputLabel>Google Maps Link</InputLabel>
            <Input placeholder="Eg: https://maps-link"/>
        </div>
    </div>
</template>

<style scoped>

</style>
