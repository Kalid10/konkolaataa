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
import {computed, ref, watch} from "vue";
import {useForm, usePage} from "@inertiajs/vue3";

const pricingOptions = [
    {name: 'Fixed Price', value: 'fixed'},
    {name: 'Negotiable', value: 'negotiable'},
    {name: 'Slightly Negotiable', value: 'slightly_negotiable'},
];

const props = defineProps(['modelValue']);
const emit = defineEmits(['update:modelValue']);

const cities = computed(() => usePage().props.cities)

const form = useForm({
    priceType: props.modelValue.priceType || null,
    price: props.modelValue.price || null,
    cityId: props.modelValue.cityId || null,
    location: props.modelValue.location || null,
    googleMapsLink: props.modelValue.googleMapsLink || null
});

watch(form, (newForm) => {
    emit('update:modelValue', newForm);
}, {deep: true});
const isValidGoogleMapsLink = ref(true);

const validateGoogleMapsLink = (link) => {
    const pattern = /^(https?:\/\/)?((www\.)?google\.com\/maps\/(?:\?q=|search\/|\?saddr=|\?daddr=|\?center=|\?ll=|@)|maps\.app\.goo\.gl\/\S+)/;
    return pattern.test(link);
};

watch(() => form.googleMapsLink, (newLink) => {
    isValidGoogleMapsLink.value = validateGoogleMapsLink(newLink);
});
</script>

<template>
    <div class="flex flex-col space-y-4 py-2">

        <div class="flex flex-col space-y-2">
            <InputLabel>Price Type</InputLabel>
            <Select v-model="form.priceType">
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
            <Input v-model="form.price" placeholder="Eg: 5,000,000"/>
        </div>

        <div class="flex flex-col space-y-2">
            <InputLabel>Select Cities</InputLabel>
            <Select v-model="form.cityId">
                <SelectTrigger>
                    <SelectValue placeholder="Select City" />
                </SelectTrigger>
                <SelectContent>
                    <SelectGroup>
                        <SelectItem v-for="item in cities" :value="item.id">
                            {{ item.name }}
                        </SelectItem>
                    </SelectGroup>
                </SelectContent>
            </Select>
        </div>

        <div class="flex flex-col space-y-2">
            <InputLabel>Location</InputLabel>
            <Input class="capitalize" v-model="form.location" placeholder="Eg: Bole, Lideta, Jemo"/>
        </div>

        <!--        Todo: Check if the google maps link is valid-->
        <div class="flex flex-col space-y-2">
            <InputLabel>Google Maps Link</InputLabel>
            <Input
                v-model="form.googleMapsLink"
                placeholder="Eg: https://maps-link"
                :class="{'border-red-500': !isValidGoogleMapsLink}"
            />
            <span v-if="!isValidGoogleMapsLink" class="text-red-500 text-sm">
      Please enter a valid Google Maps link.
    </span>
        </div>
    </div>
</template>

<style scoped>

</style>
