<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import {
    PinInput,
    PinInputGroup,
    PinInputInput,
} from '@/Components/shadcn/ui/pin-input/index.js';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';

const form = useForm({
    otp: '',
});

const value = ref([]);
const handleComplete = (e) => {
    form.otp = e.join('');
    form.post(route('verify.phone.submit'), {
        onFinish: () => form.reset('otp'),
    });
};
</script>

<template>
    <div class="min-h-screen flex flex-col items-center justify-center gap-4">
        <p class="mt-4 text-center text-gray-600 md:w-4/12 rounded-2xl shadow py-2 px-4">
            You will receive an SMS with a one-time password (OTP). Please enter the 6-digit OTP in the fields below to verify your phone number.
        </p>
        <form @submit.prevent="handleComplete(value)" class="w-full max-w-md">
            <div>
                <InputLabel for="otp" value="OTP" class="flex justify-center"/>
                <div class="mt-1 flex w-full justify-center">
                    <PinInput
                        id="pin-input"
                        v-model="value"
                        placeholder="○"
                        @complete="handleComplete"
                    >
                        <PinInputGroup>
                            <PinInputInput
                                v-for="(id, index) in 6"
                                :key="id"
                                :index="index"
                            />
                        </PinInputGroup>
                    </PinInput>
                </div>
                <InputError :message="form.errors.otp" class="mt-2 flex justify-center"/>
            </div>
            <div class="mt-6 flex justify-center">
                <PrimaryButton class="" :disabled="form.processing">
                    Verify
                </PrimaryButton>
            </div>
        </form>
    </div>
</template>

