<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Link, useForm } from '@inertiajs/vue3';
import {
    Select,
    SelectContent,
    SelectGroup,
    SelectItem,
    SelectLabel,
    SelectTrigger,
    SelectValue,
} from "@/Components/shadcn/ui/select/index.js";

const form = useForm({
    name: '',
    phone_number: '',
    password: '',
    password_confirmation: '',
    type: '',
});

const submit = () => {
    form.phone_number = `+251${form.phone_number}`;
    form.post(route('register'), {
        onSuccess: (page) => {
            if (page.props.auth.user) {
                window.location.href = route('verify.phone');
            } else {
                form.reset('password', 'password_confirmation');
            }
        },
    });
};
</script>

<template>
    <div class="px-4 w-full flex justify-evenly min-h-screen md:min-h-fit py-16 md:pt-0">
        <div class="w-full lg:w-7/12 max-w-sm md:max-w-md">
            <div class="text-5xl md:text-6xl font-medium pb-10">
                Sign up and start trading
            </div>
            <form @submit.prevent="submit">
                <div>
                    <InputLabel for="name" value="Full Name" />
                    <TextInput
                        id="name"
                        type="text"
                        class="mt-1 block w-full !bg-gray-50 !border-gray-900 !border"
                        v-model="form.name"
                        required
                        autofocus
                        autocomplete="name"
                        placeholder="Abebe Kebede"
                    />
                    <InputError class="mt-2" :message="form.errors.name" />
                </div>

                <div class="mt-4">
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

                <div class="mt-4">
                    <InputLabel for="type" value="User Type" />
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

                <div class="mt-4">
                    <InputLabel for="password" value="Password" />
                    <TextInput
                        id="password"
                        type="password"
                        class="mt-1 block w-full !bg-gray-50 !border-gray-900 !border"
                        v-model="form.password"
                        required
                        autocomplete="new-password"
                        placeholder="New Password "
                    />
                    <InputError class="mt-2" :message="form.errors.password" />
                </div>

                <div class="mt-4">
                    <InputLabel for="password_confirmation" value="Confirm Password" />
                    <TextInput
                        id="password_confirmation"
                        type="password"
                        class="mt-1 block w-full !bg-gray-50 !border-gray-900 !border"
                        v-model="form.password_confirmation"
                        required
                        autocomplete="new-password"
                        placeholder="Confirm Password"
                    />
                    <InputError class="mt-2" :message="form.errors.password_confirmation" />
                </div>

                <div class="flex items-center justify-between mt-6">
                    <Link
                        :href="route('login')"
                        class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    >
                        Already registered?
                    </Link>

                    <PrimaryButton class="ms-4 px-6" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Register
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
