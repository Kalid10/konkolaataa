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
    }
})

const emit = defineEmits(['update:range']);

const selectedFrom = ref(null);
const selectedTo = ref(null);

onMounted(() => {
    selectedFrom.value = props.initialFrom;
    selectedTo.value = props.initialTo;
});

watch([selectedFrom, selectedTo], ([newFrom, newTo]) => {
    emit('update:range', {from: newFrom, to: newTo}, useUtilities().toCamelCase(props.title));
});

function clear() {
    selectedFrom.value = null;
    selectedTo.value = null;
}

// A computed property to display the clear button
const showClearButton = computed(() => {
    return selectedFrom.value || selectedTo.value;
});
</script>

<template>
    <div class="flex flex-col space-y-2 py-4 w-full">
        <div class="flex w-full items-center space-x-1">
            <component :is="icon" size="17"/>
            <div class="font-medium text-base">{{title}}</div>
        </div>
        <div class="flex w-full space-x-2 items-center justify-between">
            <XCircle v-if="showClearButton" @click="clear" size="20" class="hover:text-red-600 hover:scale-110 cursor-pointer text-gray-50 fill-red-600"/>
            <Input v-model="selectedFrom" :placeholder="inputPlaceholder" class="text-sm md:w-32 h-8 border border-gray-900 rounded-sm px-2"/>
            <span>-</span>
            <Input v-model="selectedTo" :placeholder="inputPlaceholder2" class="border border-gray-900 rounded-sm px-2 text-sm md:w-32 h-8"/>
        </div>
    </div>
</template>

<style scoped>

</style>
