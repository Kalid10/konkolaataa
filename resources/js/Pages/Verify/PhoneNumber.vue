<script setup>
import { useForm } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';

const form = useForm({
    otp: '',
});

const submit = () => {
    form.post(route('verify.phone.submit'), {
        onFinish: () => form.reset('otp'),
    });
};
</script>

<template>
    <div class="min-h-screen flex items-center justify-center">
        <form @submit.prevent="submit" class="w-full max-w-md">
            <div>
                <InputLabel for="otp" value="OTP" />
                <TextInput
                    id="otp"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.otp"
                    required
                    autofocus
                    autocomplete="one-time-code"
                    placeholder="Enter OTP"
                />
                <InputError :message="form.errors.otp" class="mt-2" />
            </div>
            <div class="mt-6">
                <PrimaryButton class="w-full" :disabled="form.processing">
                    Verify
                </PrimaryButton>
            </div>
        </form>
    </div>
</template>
