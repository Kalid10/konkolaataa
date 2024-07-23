<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import {Link, router, useForm} from '@inertiajs/vue3';
import {
    Select,
    SelectContent,
    SelectGroup,
    SelectItem,
    SelectLabel,
    SelectTrigger,
    SelectValue,
} from "@/Components/shadcn/ui/select/index.js";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import Loading from "@/Components/Loading.vue";
import {ref} from "vue";

const form = useForm({
    name: '',
    phone_number: '',
    password: '',
    password_confirmation: '',
    type: '',
});

const isLoading = ref(false)
const submit = () => {
    isLoading.value = true;
    form.phone_number = `+251${form.phone_number}`;
    form.post(route('register'), {
        onFinish: () => {
            isLoading.value = false;
            form.reset('password', 'password_confirmation');
        },
        preserveState: true,
    });
};
</script>

<template>
    <Loading v-if="isLoading" is-full-screen type="brand"/>
    <div class="px-4 w-full flex justify-evenly min-h-screen md:min-h-fit py-5 md:pt-0">
        <div class="w-full lg:w-7/12 max-w-sm md:max-w-lg">
            <div class="flex flex-col space-y-1 pb-7 md:pb-8">

                <div class="text-2xl md:text-4xl font-semibold w-full">
                    Welcome to Konkolata
                </div>
                <div class="text-xs md:text-sm text-gray-500 pl-1">
                    To get started, please create an account.
                </div>
            </div>
            <form @submit.prevent="submit">
                <div>
                    <InputLabel for="name" value="Full Name"/>

                    <TextInput
                        id="name"
                        type="text"
                        class="mt-1 block w-full border-none !h-12"
                        v-model="form.name"
                        required
                        autofocus
                        autocomplete="name"
                        placeholder="Abebe Kebede"
                    />

                    <InputError class="mt-2" :message="form.errors.name"/>
                </div>

                <div class="mt-4">
                    <InputLabel for="phone_number" value="Phone Number"/>

                    <div class="flex items-center font-semibold min-h-full">
                        <TextInput
                            id="phone_number"
                            type="number"
                            class="mt-1 block w-full border-none !h-12"
                            v-model="form.phone_number"
                            required
                            autocomplete="number"
                            placeholder="0(9/7)11223344"
                        />
                    </div>

                    <InputError class="mt-2" :message="form.errors.phone_number"/>
                </div>

                <div class="flex flex-col space-y-1 mt-4">
                    <InputLabel for="type" value="User Type"/>
                    <Select v-model="form.type">
                        <SelectTrigger class="w-full border border-black">
                            <SelectValue placeholder="Select user type"/>
                        </SelectTrigger>
                        <SelectContent>
                            <SelectGroup>
                                <SelectLabel>User Type</SelectLabel>
                                <SelectItem value="buyer">Buyer</SelectItem>
                                <SelectItem value="seller">Seller</SelectItem>
                            </SelectGroup>
                        </SelectContent>
                    </Select>
                    <InputError class="mt-2" :message="form.errors.type"/>
                </div>


                <div class="mt-4">
                    <InputLabel for="password" value="Password"/>

                    <TextInput
                        id="password"
                        type="password"
                        class="mt-1 block w-full border-none !h-12"
                        v-model="form.password"
                        required
                        autocomplete="new-password"
                        placeholder="New Password "
                    />

                    <InputError class="mt-2" :message="form.errors.password"/>
                </div>

                <div class="mt-4">
                    <InputLabel for="password_confirmation" value="Confirm Password"/>

                    <TextInput
                        id="password_confirmation"
                        type="password"
                        class="mt-1 block w-full border-none !h-12"
                        v-model="form.password_confirmation"
                        required
                        autocomplete="new-password"
                        placeholder="Confirm Password"
                    />

                    <InputError class="mt-2" :message="form.errors.password_confirmation"/>
                </div>

                <div class="flex flex-col items-center w-full space-y-4 mt-6">
                    <PrimaryButton class="w-full flex justify-center !bg-brand-150 !py-2.5 rounded-xl !text-base"
                                   :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Register
                    </PrimaryButton>

                    <div class="flex w-full">

                        <Link
                            :href="route('login')"
                            class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        >
                            Already registered?
                        </Link>
                    </div>
                </div>
            </form>

            <SecondaryButton @click="router.visit('/auth/google')"
                             class="w-full space-x-2 !mt-8 md:mt-0 h-12 !rounded-xl !text-sm capitalize">
                <img src="../../../../public/assets/images/google_logo.png" class="w-4">
                <span>
                  Register with Google
              </span>
            </SecondaryButton>
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
