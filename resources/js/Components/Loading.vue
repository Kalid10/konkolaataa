<template>
    <div
        :class="
            isFullScreen
                ? 'fixed min-h-screen inset-0 top-0 left-0 flex items-center space-x-2 justify-center bg-black bg-opacity-70 z-50'
                : ''
        "
    >
        <!-- Existing spinner loader -->
        <div
            v-if="type === 'spinner'"
            class="animate-spin rounded-full border-[5px] sm:border-8 border-solid border-t-transparent"
            :class="{
                'h-8 w-8 sm:h-12 sm:w-12': size === 'large',
                'h-6 w-6 sm:h-8 sm:w-8': size === 'medium',
                'h-3 w-3 sm:h-6 sm:w-6': size === 'small',
                'border-indigo-100': color === 'primary',
                'border-black': color === 'secondary',
                'border-emerald-400': color === 'success',
                'border-negative-100': color === 'danger',
                'border-orange-500': color === 'warning',
                'border-sky-400': color === 'info',
                'border-neutral-200': color === 'neutral',
            }"
        ></div>

        <div class="flex animate-pulse justify-center items-center space-x-2" v-if="type === 'brand'">
            <div :class="isFullScreen ? 'border-violet-200':'border-brand-primary'" class="animate-spin rounded-full border-[5px] sm:border-8 border-solid border-t-transparent w-6 h-6 md:w-10 md:h-10"/>
            <div :class="isFullScreen ? 'text-violet-200': 'text-brand-primary'"  class="font-bold text-3xl md:text-5xl uppercase ">Konkolata</div>
        </div>

        <slot name="description"></slot>
        <!-- New bounce loader -->
        <div
            v-if="type === 'bounce' && !$slots.description"
            class="flex animate-bounce items-center justify-center space-x-2"
        >
            <div v-for="item in 3" :key="item">
                <div
                    :class="{
                        'h-8 w-8 rounded-full': size === 'large',
                        'h-4 w-4 rounded-full': size === 'medium',
                        'h-2 w-2 rounded-full': size === 'small',
                        'h-1 w-1 rounded-full': size === 'extra-small',
                        'bg-brand-100': color === 'primary',
                        'bg-black': color === 'secondary',
                        'bg-emerald-400': color === 'success',
                        'bg-negative-100': color === 'danger',
                        'bg-orange-500': color === 'warning',
                        'bg-blue-600': color === 'info',
                        'bg-neutral-200': color === 'neutral',
                    }"
                ></div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from "vue";
import {LoaderCircle} from "lucide-vue-next";
const props = defineProps({
    isFullScreen: {
        type: Boolean,
        default: false,
    },
    color: {
        type: String,
        default: "neutral",
    },
    size: {
        type: String,
        default: "large",
    },
    type: {
        type: String,
        default: "brand",
    },
});

const isFullScreen = ref(props.isFullScreen);
const color = ref(props.color);
const size = ref(props.size);
const type = ref(props.type);
</script>
