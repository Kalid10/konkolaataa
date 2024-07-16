<script lang="ts" setup>
import { ModelRef, onBeforeUnmount, onMounted, Ref, ref, watch } from "vue";
import emblaCarouselVue from "embla-carousel-vue";
import { ChevronLeft, ChevronRight, X } from "lucide-vue-next";

const props = defineProps<{
    images: Array<string>;
    currentSlide: {
        type: String;
        required: false;
        default: 1;
    };
}>();

const [emblaRef, emblaApi] = emblaCarouselVue({ loop: false });

const on: ModelRef<boolean> = defineModel("on", {
    type: Boolean,
    default: false,
});

const previousExists: Ref<Boolean> = ref(false);
const nextExists: Ref<Boolean> = ref(false);
const currentSlide: Ref<number> = ref(props.currentSlide);
const totalSlides: Ref<number> = ref(0);

function scrollLeft(event: Event) {
    stopPropagation(event);
    if (emblaApi.value) {
        if (emblaApi.value.canScrollPrev()) {
            emblaApi.value.scrollPrev();
        }
    }
}

function scrollRight(event: Event) {
    stopPropagation(event);
    if (emblaApi.value) {
        if (emblaApi.value.canScrollNext()) {
            emblaApi.value.scrollNext();
        }
    }
}

function updateCurrentState() {
    if (emblaApi.value) {
        currentSlide.value = emblaApi.value.selectedScrollSnap() + 1;
        previousExists.value = emblaApi.value.canScrollPrev();
        nextExists.value = emblaApi.value.canScrollNext();
    }
}

function setCurrentState() {
    updateCurrentState();
    totalSlides.value = emblaApi.value ? emblaApi.value.slideNodes().length : 0;
}

function stopPropagation(event: Event) {
    event.stopPropagation();
}

function openCarousel() {
    if (emblaApi.value) {
        emblaApi.value.on("init", setCurrentState);
        emblaApi.value.on("reInit", setCurrentState);
        emblaApi.value.on("select", updateCurrentState);
    }
    document.body.style.overflow = "hidden";
}

function closeCarousel() {
    document.body.style.overflow = "";
    on.value = false;
}

watch(on, (value) => {
    if (value) {
        openCarousel();
    }
});

onMounted(() => {
    if (on.value) {
        openCarousel();
    }
});

onBeforeUnmount(() => {
    emblaApi.value?.destroy();
    emblaApi.value?.off("init", setCurrentState);
    emblaApi.value?.off("select", updateCurrentState);
});

window.addEventListener("keydown", (event) => {
    if (event.key === "Escape") {
        closeCarousel();
    }
});

window.addEventListener("keydown", (event) => {
    if (event.key === "ArrowRight") {
        scrollRight(event);
    } else if (event.key === "ArrowLeft") {
        scrollLeft(event);
    }
});
</script>

<template>
    <Transition name="darken">
        <div
            v-show="on"
            class="fixed bottom-0 left-0 right-0 top-0 z-50 grid w-full place-items-center bg-black/90"
            @click="closeCarousel"
        >
            <div
                class="absolute left-0 right-0 top-0 flex items-center justify-end p-3"
            >
                <X class="h-6 w-6 stroke-white" />
            </div>

            <div
                ref="emblaRef"
                class="embla relative w-full"
                @click="stopPropagation"
            >
                <div class="embla__container w-full">
                    <div
                        v-for="(image, i) in images"
                        class="embla__slide flex items-center justify-center"
                    >
                        <img
                            :key="i"
                            :alt="`Property ${i}`"
                            :src="image"
                            class="w-full max-w-2xl"
                        />
                    </div>
                </div>
                <div
                    class="mx-auto flex w-full max-w-2xl items-center justify-end p-3 text-white"
                >
                    {{ currentSlide }} of {{ totalSlides }}
                </div>
            </div>

            <div
                class="fixed bottom-0 flex w-full items-center justify-center gap-4 p-4"
            >
                <button
                    :disabled="!previousExists"
                    class="grid h-12 w-12 place-items-center disabled:opacity-25"
                    @click="scrollLeft"
                >
                    <ChevronLeft class="h-6 w-6 stroke-white" />
                </button>
                <button
                    :disabled="!nextExists"
                    class="grid h-12 w-12 place-items-center disabled:opacity-25"
                    @click="scrollRight"
                >
                    <ChevronRight class="h-6 w-6 stroke-white" />
                </button>
            </div>
        </div>
    </Transition>
</template>

<style scoped>
.embla {
    overflow: hidden;
}

.embla__container {
    display: flex;
}

.embla__slide {
    flex: 0 0 100%;
    min-width: 0;
}

.darken-enter-active {
    transition: opacity 0.1s ease-out;
}

.darken-leave-active {
    transition: opacity 0s ease-out;
}

.darken-enter-from {
    opacity: 75%;
}
</style>
