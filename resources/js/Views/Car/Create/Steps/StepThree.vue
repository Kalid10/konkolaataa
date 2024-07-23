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
import {Switch} from "@/Components/shadcn/ui/switch/index.js";
import {CircleX} from "lucide-vue-next";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {useCreateCar} from "@/Composables/useCreateCar.js";


const props = defineProps(['modelValue']);
const emit = defineEmits(['update:modelValue']);

const colors = computed(() => usePage().props.colors);

const severityOfAccidents = [
    {name: 'Minor', value: 'minor'},
    {name: 'Moderate', value: 'moderate'},
    {name: 'Severe', value: 'severe'},
];
const motorStatus = [
    {name: 'Clean, never been opened', value: 'clean'},
    {name: 'Working, but needs repair', value: 'needs_repair'},
    {name: 'Repaired', value: 'repaired'},
    {name: 'Unknown', value: 'unknown'},
]
const form = useForm({
    exteriorColorId: props.modelValue.exteriorColorId || null,
    interiorColorId: props.modelValue.interiorColorId || null,
    isOriginalPaint: props.modelValue.isOriginalPaint || true,
    isAccidentFree: props.modelValue.isAccidentFree || 1,
    severityOfAccident: props.modelValue.severityOfAccident || 'none',
    numberOfSeats: props.modelValue.numberOfSeats || 5,
    motorStatus: props.modelValue.motorStatus || null,
});

watch(form, (newForm) => {
    emit('update:modelValue', newForm);
}, {deep: true});

watch(() => form.isAccidentFree, (value) => {
    if (value) {
        form.numberOfAccidents = 0;
    }

    form.isAccidentFree = value ? 1 : 0;
});

const showCarConditionSection = ref(false);
const { carFormData } = useCreateCar();
</script>

<template>
    <div class="flex flex-col space-y-4">
        <div class="flex flex-col space-y-2">
            <InputLabel>Number Of Seats (Including Driver)</InputLabel>
            <Input
                v-model="form.numberOfSeats"
                placeholder="Eg: 5"
            />
        </div>
        <div class="flex flex-col space-y-2">
            <InputLabel>Exterior Color</InputLabel>
            <Select v-model="form.exteriorColorId">
                <SelectTrigger>
                    <SelectValue placeholder="Select Color"/>
                </SelectTrigger>
                <SelectContent>
                    <SelectGroup>
                        <SelectItem v-for="item in colors" :value="item.id">
                            <div class="!flex space-x-2 items-center">

                                <div class="w-3 h-3 rounded-full border border-gray-200"
                                     :style="'background-color:'+ item.name"></div>
                                <div> {{ item.name }}</div>
                            </div>
                        </SelectItem>
                    </SelectGroup>
                </SelectContent>
            </Select>
        </div>

        <div class="flex flex-col space-y-2">
            <InputLabel>Interior/Dashboard Color</InputLabel>
            <Select v-model="form.interiorColorId">
                <SelectTrigger>
                    <SelectValue placeholder="Select Color"/>
                </SelectTrigger>
                <SelectContent>
                    <SelectGroup>
                        <SelectItem v-for="item in colors" :value="item.id">
                            <div class="!flex space-x-2 items-center">

                                <div class="w-3 h-3 rounded-full border border-gray-200"
                                     :style="'background-color:'+ item.name"></div>
                                <div> {{ item.name }}</div>
                            </div>
                        </SelectItem>
                    </SelectGroup>
                </SelectContent>
            </Select>
        </div>
        <div v-if="!showCarConditionSection" class="py-4 w-full">
            <div v-if="carFormData.stepTwo.carConditionTypeId === 1" class="text-sm text-red-600 font-medium py-2">* Disabled because the car is brand new</div>
            <PrimaryButton :disabled="carFormData.stepTwo.carConditionTypeId === 1"  @click="showCarConditionSection = true" class="!bg-red-600 !w-full md:w-10/12 text-brand-primary text-sm cursor-pointer hover:font-medium">Add Accident/Condition Details</PrimaryButton>
        </div>
        <div class="flex flex-col space-y-4 py-2" v-if="showCarConditionSection">
            <div class="flex justify-between">
            <div class="font-semibold text-xl">Accident & Car Condition</div>
                <CircleX @click="showCarConditionSection = false" class="text-white hover:text-black cursor-pointer w-4 fill-red-600 hover:scale-110"/>
            </div>

                <div class="flex items-center py-2 space-x-4">
                    <Switch @update:checked="form.isOriginalPaint = !form.isOriginalPaint"
                            :checked="form.isOriginalPaint"/>
                    <InputLabel>Is Original Paint?</InputLabel>
                </div>

            <div class="flex flex-col space-y-2">
                <InputLabel>Motor Status</InputLabel>
                <Select v-model="form.motorStatus">
                    <SelectTrigger>
                        <SelectValue placeholder="Select Motor Status"/>
                    </SelectTrigger>
                    <SelectContent>
                        <SelectGroup>
                            <SelectItem v-for="(item, key) in motorStatus" :value="key">
                                    <div> {{ item.name }}</div>
                            </SelectItem>
                        </SelectGroup>
                    </SelectContent>
                </Select>
            </div>

                <div class="flex items-center space-x-4 py-2">
                    <Switch @update:checked="form.isAccidentFree = !form.isAccidentFree"
                            :checked="form.isAccidentFree"/>
                    <InputLabel>Is Accident Free?</InputLabel>
                </div>

            <div v-if="!form.isAccidentFree" class="flex flex-col space-y-2">
                <InputLabel>Severity Of Accidents</InputLabel>
                <Select :disabled="form.isAccidentFree" v-model="form.severityOfAccident">
                    <SelectTrigger>
                        <SelectValue placeholder="Select Accident Severity"/>
                    </SelectTrigger>
                    <SelectContent>
                        <SelectGroup>
                            <SelectItem v-for="item in severityOfAccidents" :value="item.value">
                                {{ item.name }}
                            </SelectItem>
                        </SelectGroup>
                    </SelectContent>
                </Select>
            </div>

        </div>
    </div>
</template>

<style scoped>

</style>
