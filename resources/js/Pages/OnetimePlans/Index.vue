<template>
    <div class="container mx-auto py-10">
        <h1 class="text-2xl font-bold mb-6 text-center">Pick a One-Time Plan</h1>
        <div class="flex justify-center mb-6">
            <button
                v-for="plan in plans"
                :key="plan.id"
                @click="selectPlan(plan)"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 m-2 rounded focus:outline-none focus:shadow-outline"
            >
                {{ plan.title }} - {{ plan.amount }} {{ plan.currency }}
            </button>
        </div>
        <form @submit.prevent="subscribe" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <input type="hidden" v-model="form.plan" />
            <div v-if="selectedPlan" class="mb-4">
                <h2 class="text-xl font-bold mb-2 text-center">{{ selectedPlan.title }}</h2>
                <p class="text-center mb-4">{{ selectedPlan.description }}</p>
                <div class="border p-4 rounded shadow-md">
                    <h3 class="text-lg font-semibold mb-2">Features:</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div v-for="feature in selectedPlan.features" :key="feature" class="flex items-center">
                            <svg class="w-6 h-6 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span>{{ feature }}</span>
                        </div>
                    </div>
                    <div class="mt-4">
                        <h3 class="text-lg font-semibold">Duration:</h3>
                        <p>{{ selectedPlan.duration_in_days }} days</p>
                    </div>
                    <div class="mt-4">
                        <h3 class="text-lg font-semibold">Max Posts:</h3>
                        <p>{{ selectedPlan.max_posts }}</p>
                    </div>
                </div>
            </div>
            <div class="flex items-center justify-center mt-6">
                <button
                    type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                    :disabled="!selectedPlan"
                >
                    Get Started
                </button>
            </div>
        </form>
    </div>
</template>

<script setup>
import {computed, ref, watch} from 'vue';
import {useForm, usePage} from '@inertiajs/vue3';

const plans = computed(() => usePage().props.plans)
const selectedPlan = ref(null);

const form = useForm({
    plan: '',
});

const selectPlan = (plan) => {
    // Ensure features is parsed as an array
    selectedPlan.value = { ...plan, features: JSON.parse(plan.features) };
    form.plan = plan.id;
};

const subscribe = () => {
    form.post(route('onetime.subscribe'), {
        onSuccess: (response) => {
            console.log('Success:', response);
            form.reset('plan');
            selectedPlan.value = null;
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
