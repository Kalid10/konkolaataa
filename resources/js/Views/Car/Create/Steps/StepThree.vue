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
import {computed, watch} from "vue";
import {useForm, usePage} from "@inertiajs/vue3";
import {Switch} from "@/Components/shadcn/ui/switch/index.js";


const props = defineProps(['modelValue']);
const emit = defineEmits(['update:modelValue']);

const colors = computed(() => usePage().props.colors);

const form = useForm({
    exteriorColorId: props.modelValue.exteriorColorId || null,
    interiorColorId: props.modelValue.interiorColorId || null,
    isOriginalPaint: props.modelValue.isOriginalPaint || true,
    isAccidentFree: props.modelValue.isAccidentFree || 1,
    severityOfAccident: props.modelValue.severityOfAccident || null,
});

watch(form, (newForm) => {
    emit('update:modelValue', newForm);
}, {deep: true});

watch(() => form.isAccidentFree, (value) => {
    if (value) {
        form.numberOfAccidents = 0;
    }

    form.isAccidentFree = value ? 1:0;
});

const severityOfAccidents = [
    {name: 'Minor', value: 'minor'},
    {name: 'Moderate', value: 'moderate'},
    {name: 'Severe', value: 'severe'},
];
</script>

<template>
    <div class="flex flex-col space-y-4 py-2">
        <div class="flex flex-col space-y-2">
            <InputLabel>Exterior Color</InputLabel>
            <Select v-model="form.exteriorColorId">
                <SelectTrigger>
                    <SelectValue placeholder="Select Color" />
                </SelectTrigger>
                <SelectContent>
                    <SelectGroup>
                        <SelectItem  v-for="item in colors" :value="item.id">
                            <div class="!flex space-x-2 items-center">

                                <div class="w-3 h-3 rounded-full border border-gray-200" :style="'background-color:'+ item.name"></div>
                                <div>  {{ item.name }} </div>
                            </div>
                        </SelectItem>
                    </SelectGroup>
                </SelectContent>
            </Select>
        </div>

        <div class="flex items-center py-2 space-x-4">
            <InputLabel>Is Original Paint?</InputLabel>
            <Switch @update:checked="form.isOriginalPaint = !form.isOriginalPaint" :checked="form.isOriginalPaint"/>
        </div>

        <div class="flex flex-col space-y-2">
            <InputLabel>Interior Color</InputLabel>
            <Select v-model="form.interiorColorId">
                <SelectTrigger>
                    <SelectValue placeholder="Select Color" />
                </SelectTrigger>
                <SelectContent>
                    <SelectGroup>
                        <SelectItem  v-for="item in colors" :value="item.id">
                            <div class="!flex space-x-2 items-center">

                                <div class="w-3 h-3 rounded-full border border-gray-200" :style="'background-color:'+ item.name"></div>
                                <div>  {{ item.name }} </div>
                            </div>
                        </SelectItem>
                    </SelectGroup>
                </SelectContent>
            </Select>
        </div>
        <div class="flex items-center space-x-4 py-2">
            <InputLabel>Is Accident Free?</InputLabel>
            <Switch @update:checked="form.isAccidentFree = !form.isAccidentFree" :checked="form.isAccidentFree"/>
        </div>

        <div class="flex flex-col space-y-2">
            <InputLabel>Severity Of Accidents</InputLabel>
            <Select :disabled="form.isAccidentFree" v-model="form.severityOfAccident">
                <SelectTrigger>
                    <SelectValue placeholder="Select Accident Severity" />
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
</template>

<style scoped>

</style>
