<script setup>

import {
    Select, SelectContent,
    SelectGroup,
    SelectItem,
    SelectLabel,
    SelectTrigger,
    SelectValue
} from "@/Components/shadcn/ui/select/index.js";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {Link, useForm} from "@inertiajs/vue3";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import Loading from "@/Components/Loading.vue";
import {ref} from "vue";

const props = defineProps({
    email: {
        type: String,
        required: true
    },
    name: {
        type: String,
        required: true
    },
})

const form = useForm({
    email: props.email,
    name: props.name,
    phone_number: '943104396',
    type: null,
});
const isLoading = ref(false);
const submit = () => {
    isLoading.value = true;
    form.phone_number = `+251${form.phone_number}`;
    form.post('/register', {
        onFinish: () => {
            isLoading.value = false;
        },
        preserveState: true,
    });
};
</script>

<template>
    <Loading is-full-screen v-if="isLoading"/>
    <div class="px-4 w-full flex justify-evenly min-h-screen md:min-h-fit py-16 md:pt-0">

    <div class="w-full lg:w-7/12 max-w-sm md:max-w-md">
        <div class="font-semibold text-3xl text-center py-5 capitalize">Welcome to Konkolaataa</div>

        <form @submit.prevent="submit">
            <div class="mt-4 flex flex-col space-y-1 opacity-50">
                <InputLabel for="email" value="Email" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full !bg-gray-50 !border-gray-900 !border"
                    :value="email"
                    v-model="form.email"
                    :disabled="true"
                    required
                    autofocus
                    autocomplete="name"
                    placeholder="Abebe Kebede"
                />

                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div class="mt-4 flex flex-col space-y-1">
                <InputLabel for="name" value="Full Name *" />

                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full !bg-gray-50 !border-gray-900 !border capitalize"
                    v-model="form.name"
                    required
                    autofocus
                    autocomplete="name"
                    placeholder="Abebe Kebede"
                />

                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div class="mt-4 flex flex-col space-y-1">
                <InputLabel for="phone_number" value="Phone Number" />

                <div class="flex items-center font-semibold min-h-full">
                    <div class="bg-brand-primary text-white px-3 py-3.5 h-full rounded-l-lg min-h-full">+251</div>

                    <TextInput
                        id="phone_number"
                        type="number"
                        class="block w-full !bg-gray-50 !border-gray-900 !border !rounded-none !rounded-r-lg"
                        v-model="form.phone_number"
                        required
                        autocomplete="number"
                        placeholder="(9/7)11223344"
                    />
                </div>

                <InputError class="mt-2" :message="form.errors.phone_number" />
            </div>

            <InputLabel class="p-2 rounded-lg bg-rose-600 text-white mt-3">
                Link your phone number with your email to log in. If you don't have an account, one will be created for you.
            </InputLabel>

            <div class="mt-4 flex flex-col space-y-1">
                <InputLabel for="type" value="User Type *" />
                <Select v-model="form.type">
                    <SelectTrigger class="w-full border border-black">
                        <SelectValue placeholder="Select user type" />
                    </SelectTrigger>
                    <SelectContent>
                        <SelectGroup>
                            <SelectLabel>User Type</SelectLabel>
                            <SelectItem value="buyer">Buyer</SelectItem>
                            <SelectItem value="seller">Seller</SelectItem>
                        </SelectGroup>
                    </SelectContent>
                </Select>
                <InputError class="mt-2" :message="form.errors.type" />
            </div>

            <div class="flex items-center justify-between mt-6">
                <PrimaryButton class=" px-6 w-full" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Complete Registration
                </PrimaryButton>
            </div>
        </form>
    </div>
        <div class="hidden lg:flex flex-col space-y-2 w-4/12 text-center rounded-lg justify-center items-center">
            <div class="text-4xl font-bold text-brand-100">
                <span class="text-brand-150">Konkolaataa</span>
            </div>
            <div class="text-sm text-gray-700">
                Your One-Stop Marketplace to Buy and Sell Cars
            </div>
        </div>

    </div>
</template>

<style scoped>

</style>
