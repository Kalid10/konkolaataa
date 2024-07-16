<script setup>
import { Link } from "@inertiajs/vue3";
import { ChevronLeftIcon, ChevronRightIcon } from "lucide-vue-next"
import { computed } from "vue";

const props = defineProps({
    links: {
        type: Array,
        default: null,
    },
    preserveState: {
        type: Boolean,
        default: false,
    },
    position: {
        type: String,
        default: "right",
        validator: (value) => ["left", "center", "right"].includes(value),
    },
});

const paginationPosition = computed(() => {
    switch (props.position) {
        case "left":
            return "justify-start";
        case "center":
            return "justify-center";
        case "right":
            return "justify-end";
        default:
            return "justify-end";
    }
});
</script>
<template>
    <div
        v-if="links.length > 3"
        class="flex justify-center w-full"
        :class="paginationPosition"
    >
        <div class="flex flex-wrap w-fit max-w-lg space-x-5 items-center py-5 mx-auto">
            <template v-for="(link, p) in links" :key="p">
                <Link
                    v-if="link.url !== null"
                    :href="link.url"
                    :preserve-state="preserveState"
                    class="flex h-10 w-fit hover:w-10 cursor-pointer flex-wrap items-center justify-center rounded-xl text-center text-xs font-light hover:bg-brand-primary hover:font-semibold hover:text-white"
                    :class="{
                        'bg-indigo-200 font-semibold w-10': link.active,
                    }"
                >
                    <div
                        v-if="link.label.includes('Previous')"
                        class="p-2 rounded-xl bg-indigo-200 flex items-center font-medium text-sm"
                    >
                        <ChevronLeftIcon class="w-5"/>
                        <span class="text-xs">
                           Previous
                       </span>
                    </div>

                    <div
                        v-if="link.label.includes('Next')"
                        class="p-2 rounded-xl bg-indigo-200 flex items-center font-light text-sm"
                    >
                        <span class="text-xs">
                            Next
                        </span>
                        <ChevronRightIcon
                            v-if="link.label.includes('Next')"
                            class="w-5"
                        />
                    </div>

                    <div class="font-medium text-sm w-9">
                    <span
                        class="font-medium"
                        v-if="
                            !link.label.includes('Previous') &&
                            !link.label.includes('Next')
                        ">{{ link.label }}</span>
                    </div>
                </Link>
            </template>
        </div>
    </div>
</template>
