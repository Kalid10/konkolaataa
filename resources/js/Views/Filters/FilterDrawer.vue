<script setup xmlns="http://www.w3.org/1999/html">
import {
    DrawerContent,
    DrawerOverlay,
    DrawerPortal,
    DrawerRoot,
    DrawerTrigger
} from "vaul-vue";
import { ref } from "vue";
import {DollarSign, X} from "lucide-vue-next";
import MobileFilters from "@/Views/Filters/MobileFilters.vue";
import Header from "@/Components/Header.vue";
import InputRangeFilter from "@/Views/Filters/InputRangeFilter.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const props = defineProps({
    isDrawerOpen: {
        type: Boolean,
        default: false
    }
})
const isDrawerOpen = ref(props.isDrawerOpen);

function setDrawerOpen(val) {
    isDrawerOpen.value = val;
}

const selected = ref(null);
function setupSelected(item){
    selected.value = item;
}
</script>

<template>
    <DrawerRoot>
            <DrawerTrigger>
                <MobileFilters @selected="setupSelected"/>
            </DrawerTrigger>
        <DrawerPortal>
            <DrawerOverlay class="z-50 fixed bg-black/80 inset-0" />
            <DrawerContent
                class="bg-white flex flex-col rounded-t-xl !h-3/5 max-h-[calc(100%-(env(safe-area-inset-top)+75px+1rem))] fixed bottom-0 left-0 right-0 z-[60]">
                <div class="w-full rounded-t-xl text-black flex flex-col space-y-2 px-4">
                    <div class="mt-4 mx-auto w-14 h-1.5 flex-shrink-0 rounded-full bg-gray-300 mb-5" />
                    <Header class="text-center" :title="'Filter By ' + selected"/>
                    <div class="w-full">
                    <InputRangeFilter title="Price" :icon="DollarSign"/>
                        <PrimaryButton class="w-full !justify-center">Submit</PrimaryButton>
                    </div>
                </div>
            </DrawerContent>
        </DrawerPortal>
    </DrawerRoot>
</template>

<style scoped></style>
