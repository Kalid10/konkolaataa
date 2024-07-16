<script setup>
import {computed, onMounted, ref, watch} from "vue";
import {useUtilities} from "@/Composables/useUtilities.js";
import {Input} from "@/Components/shadcn/ui/input/index.js";
import {XCircle} from "lucide-vue-next";

const props = defineProps({
    title: {
        type: String,
        required: true
    },
    inputPlaceholder: {
        type: String,
        default: "From"
    },
    inputPlaceholder2: {
        type: String,
        default: "To"
    },
    icon: {
        type: Object,
        required: true
    },
    initialFrom: {
        type: String,
        default: null
    },
    initialTo: {
        type: String,
        default: null
    },
    minAmount: {
        type: Number,
        default: 0
    },
    maxAmount: {
        type: Number,
        default: Infinity
    },
    alignment: {
        type: String,
        default: "horizontal"
    },
    showHeader: {
        type: Boolean,
        default: true
    }
});

const emit = defineEmits(['update:range']);

const selectedFrom = ref(null);
const selectedTo = ref(null);

onMounted(() => {
    selectedFrom.value = props.initialFrom;
    selectedTo.value = props.initialTo;
});

watch([selectedFrom, selectedTo], ([newFrom, newTo]) => {
    if (newFrom !== null && (newFrom < props.minAmount || newFrom > props.maxAmount)) {
        selectedFrom.value = null; // Reset if out of bounds
    }
    if (newTo !== null && (newTo < props.minAmount || newTo > props.maxAmount)) {
        selectedTo.value = null; // Reset if out of bounds
    }
    emit('update:range', {from: newFrom, to: newTo}, useUtilities().toCamelCase(props.title));
});

function clear() {
    selectedFrom.value = null;
    selectedTo.value = null;
}

const showClearButton = computed(() => {
    return selectedFrom.value || selectedTo.value;
});

const isFromInvalid = computed(() => {
    console.log(selectedFrom.value, props.minAmount, props.maxAmount);
    return selectedFrom.value !== null && (selectedFrom.value < props.minAmount || selectedFrom.value > props.maxAmount);
});

const isToInvalid = computed(() => {
    return selectedTo.value !== null && (selectedTo.value < props.minAmount || selectedTo.value > props.maxAmount);
});
</script>

<template>
    <div class="flex flex-col space-y-4 pb-2 md:py-4 w-full">
        <div class="flex w-full space-x-2 items-center justify-center p-2 rounded-lg bg-slate-100" v-if="showHeader">
            <component :is="icon" size="17"/>
            <div class="font-medium text-base capitalize">{{ title }}</div>
        </div>
        <div class="flex w-full items-center justify-between"
             :class="alignment === 'vertical' ? 'flex-col space-y-3' : 'flex-row space-x-2'">
            <XCircle v-if="showClearButton" @click="clear" size="20"
                     :class="alignment === 'vertical' ? 'hidden' : 'inline-flex'"
                     class="hover:text-red-600 hover:scale-110 cursor-pointer text-gray-50 fill-red-600"/>
            <Input v-model="selectedFrom" :placeholder="inputPlaceholder"
                   :class="{'!border-red-500': isFromInvalid, 'w-5/12': alignment === 'horizontal', 'w-full !h-10': alignment ==='vertical'}"
                   class="text-sm h-8 border border-gray-900 rounded-sm px-2"
            />
            <span>-</span>
            <Input v-model="selectedTo" :placeholder="inputPlaceholder2"
                   :class="{'border-red-500': isToInvalid,  'w-5/12': alignment === 'horizontal', 'w-full !h-10': alignment ==='vertical'}"
                   class="border border-gray-900 rounded-sm px-2 text-sm h-8"/>
        </div>
    </div>
</template>
