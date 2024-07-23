<script setup>
import { onMounted, ref } from 'vue';

const model = defineModel({
    type: String,
    required: true,
});

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
    <input
        class="bg-[#f8f8f8] border border-gray-400 focus:border-brand-primary !focus:ring-brand-primary rounded-lg shadow-sm p-3 font-light text-sm"
        v-model="model"
        ref="input"
    />
</template>
