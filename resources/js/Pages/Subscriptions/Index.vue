<template>
    <div class="container mx-auto py-10 space-y-5">
        <h1 class="text-2xl font-bold mb-6 text-center">Subscribe</h1>
        <select v-model="form.plan" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            <option value="">Select a plan</option>
            <option v-for="plan in subscriptionPlans" :value="plan.id" :key="plan.id">{{ plan.title }}</option>
        </select>

        <button
            @click="subscribe"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
            :disabled="!form.plan"
        >
            Subscribe
        </button>
    </div>
</template>

<script setup>
import { computed } from 'vue';
import { useForm, usePage } from '@inertiajs/vue3';

const subscriptionPlans = computed(() => usePage().props.plans);

const form = useForm({
    plan: '',
});

const subscribe = () => {
    form.post(route('subscribe'), {
        onSuccess: (response) => {
            console.log('Success:', response);
            form.reset('plan');
        },
        onError: (errors) => {
            console.log('Error:', errors);
        }
    });
};
</script>

<style scoped>
.container {
    max-width: 600px;
}
</style>
