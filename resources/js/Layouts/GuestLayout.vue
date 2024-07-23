<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="min-h-screen max-w-screen-2xl mx-auto w-full flex flex-col sm:justify-center items-center pt-6 sm:pt-0 ">

        <div
            class="w-full h-full px-6 bg-white  sm:rounded-lg"
        >
            <slot />
        </div>
    </div>
</template>
