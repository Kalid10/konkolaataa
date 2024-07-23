<script setup>
defineProps({
    disabled: {
        type: Boolean,
        default: false
    }
})
</script>
<template>
    <button
        :disabled="disabled"
        :class="disabled ? 'opacity-60 cursor-not-allowed ' : 'opacity-100'"
        class="inline-flex h-fit justify-center items-center px-4 py-2 bg-brand-primary border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-brand-primary focus:bg-brand active:bg-brand-primary focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 max-w-lg hover:scale-105"
    >
        <slot />
    </button>
</template>
