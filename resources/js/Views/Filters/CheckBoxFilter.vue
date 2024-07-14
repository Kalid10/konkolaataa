<script setup>
import { computed, onMounted, ref, watch } from 'vue';
import { Checkbox } from "@/Components/shadcn/ui/checkbox/index.js";
import { Switch } from "@/Components/shadcn/ui/switch/index.js";
import { useUtilities } from "@/Composables/useUtilities.js";
import { XCircle } from "lucide-vue-next";

const props = defineProps({
    items: {
        type: Array,
        required: true
    },
    title: {
        type: String,
        required: true
    },
    icon: {
        type: Object,
        required: true
    },
    showColorBadge: {
        type: Boolean,
        default: false,
    },
    initialCheckedItems: {
        type: Array,
        default: () => []
    },
    showPlateInfo: {
        type: Boolean,
        default: false,
    },
    showHeader: {
        type: Boolean,
        default: true
    },
    itemsToShow: {
        type: Number,
        default: 4
    }
});

const emit = defineEmits(['update:checked']);
const utilities = useUtilities();
const allChecked = ref(false);
const checkedItems = ref([]);
const showMore = ref(false);
const itemsToShow = ref(props.itemsToShow);

// Initialize checkedItems with persisted data
onMounted(() => {
    checkedItems.value = props.items.map(item => {
        const isChecked = props.initialCheckedItems.some(checkedItem => {
            return String(checkedItem.name) === String(item.name);
        });
        return { ...item, checked: isChecked };
    });
    // Set allChecked if all items are initially checked
    allChecked.value = checkedItems.value.every(item => item.checked);
});

const toggleAll = (checked) => {
    allChecked.value = checked;
    checkedItems.value.forEach(item => item.checked = checked);
    emitCheckedItems();
};

const toggleItem = (item) => {
    item.checked = !item.checked;
    // Update allChecked state based on checkedItems
    allChecked.value = checkedItems.value.every(item => item.checked);
    emitCheckedItems();
};

const emitCheckedItems = () => {
    const selectedItems = checkedItems.value.filter(item => item.checked).map(item => ({id: item.id, name: item.name, value: item.value}));
    emit('update:checked', selectedItems, utilities.toCamelCase(props.title));
};

const clear = () => {
    checkedItems.value.forEach(item => item.checked = false);
    allChecked.value = false;
    emitCheckedItems();
};

const hasCheckedItems = computed(() => checkedItems.value.some(item => item.checked));

const visibleItems = computed(() => {
    return showMore.value ? checkedItems.value : checkedItems.value.slice(0, itemsToShow.value);
});

const toggleShowMore = () => {
    showMore.value = !showMore.value;
};
</script>

<template>
    <div class="flex flex-col space-y-2 md:pt-4 text-sm">
        <div class="flex w-full items-center p-2 rounded-lg bg-slate-100" v-if="showHeader">
            <XCircle v-if="hasCheckedItems" @click="clear" size="20" class="hover:text-black hover:scale-110 cursor-pointer text-gray-50 fill-red-600"/>

            <div class="w-11/12 flex space-x-2 justify-center items-center">
                <component :is="icon" size="17"/>
                <div class="font-medium text-base capitalize">{{ title }}</div>
            </div>
        </div>
        <div class="flex flex-col space-y-3">
            <div class="flex items-center justify-between p-2">
                <div>All {{ title }}'s</div>
                <Switch v-model:checked="allChecked" @update:checked="toggleAll"/>
            </div>
            <div v-for="item in visibleItems" :key="item.id" class="flex items-center justify-between w-full px-1 py-0.5">
                <div class="flex space-x-2 items-center w-9/12">
                    <Checkbox class="w-3.5 h-3.5" :checked="item.checked" @update:checked="() => toggleItem(item)"/>
                    <div class="flex items-center space-x-1">
                        <div v-if="showColorBadge" class="min-w-4 h-4 rounded-full border border-gray-300" :style="{ backgroundColor: item.hex }"></div>
                        <span v-if="showPlateInfo" :class="[item.value === 1 ? 'bg-red-600 text-white' : item.value === 2 ? 'bg-blue-600 text-white' : item.value === 3 ? 'bg-emerald-400 text-white' : '']" class="px-2 font-semibold rounded-lg">{{ item.value }}</span>
                        <span class="capitalize">{{ utilities.removeUnderscores(item.name) }}</span>
                    </div>
                </div>
            </div>
            <div v-if="checkedItems.length > itemsToShow" class="flex justify-center">
                <button @click="toggleShowMore" class="text-blue-600">
                    {{ showMore ? 'Show less' : 'Show more' }}
                </button>
            </div>
        </div>
    </div>
</template>
