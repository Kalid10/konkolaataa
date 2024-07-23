<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import {Link, router, useForm} from '@inertiajs/vue3';
import SecondaryButton from "@/Components/SecondaryButton.vue";
import Loading from "@/Components/Loading.vue";
import {ref} from "vue";
import {EyeIcon, FacebookIcon} from "lucide-vue-next";

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    login: '',
    password: '',
    remember: false,
});

const isLoading = ref(false);
const submit = () => {
    isLoading.value = true;
    form.login = `+251${form.login}`;
    form.post(route('login'),{
        onFinish:() => {
            isLoading.value = false,
                form.reset('password')
        }
    });
};

function loginViaGoogle(){
    isLoading.value = true;
    router.visit('/auth/google',{
        onFinish:() => isLoading.value = false
    })
}
</script>

<template>
    <Loading is-full-screen v-if="isLoading" />
    <div class="px-3 w-full flex justify-evenly mx-auto min-h-screen md:min-h-fit py-16 md:pt-0 ">
        <div class="w-full lg:w-7/12 max-w-sm md:max-w-md flex flex-col space-y-4">
            <div class="flex flex-col space-y-1 justify-between pb-2">
                <div class="text-5xl font-semibold w-full">
                  Welcome Back!
                </div>
                <div class="text-sm text-gray-500 pl-1">
                    To get started, please sign in to your account.
                </div>
            </div>
            <form @submit.prevent="submit">
                <div class="flex flex-col space-y-2">
                        <TextInput
                            id="login"
                            type="number"
                            class="mt-1 block w-full !h-12 !border-none"
                            v-model="form.login"
                            required
                            autofocus
                            autocomplete="number"
                            placeholder="(09/07)12345678"
                        />
                    <InputError class="mt-2" :message="form.errors.login"/>
                </div>

                <div class="mt-8">
                    <TextInput
                        id="password"
                        type="password"
                        class="mt-1 block w-full border-none !h-12"
                        v-model="form.password"
                        required
                        autocomplete="current-password"
                        placeholder="Password"
                    >
                        <EyeIcon/>
                    </TextInput>

                    <InputError class="mt-2" :message="form.errors.password"/>
                </div>

                <div class="flex justify-between items-center py-2 mt-4">
                    <label class="flex items-center">
                        <Checkbox class="!rounded-2xl" name="remember" v-model:checked="form.remember"/>
                        <span class="ms-2 text-sm text-gray-600">Remember me</span>
                    </label>
                    <Link
                        v-if="canResetPassword"
                        :href="route('password.request')"
                        class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    >
                        Forgot your password?
                    </Link>
                </div>

                <div class="flex items-center text-center mt-4">


                    <PrimaryButton class="w-full flex justify-center !bg-brand-150 !py-2.5 rounded-xl !text-base"
                                   :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Log in
                    </PrimaryButton>
                </div>

<!--                <div class="flex justify-center py-3">-->
<!--                    <Link-->
<!--                        :href="route('register')"-->
<!--                        class="text-center text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900"-->
<!--                    >-->
<!--                        Don't have an account? <span class="underline">-->
<!--                    Register-->
<!--                </span>-->
<!--                    </Link>-->
<!--                </div>-->
            </form>

            <div class="flex justify-between items-center py-3">
                <div class="w-4/12 bg-gray-200 h-0.5"></div>
                <div class="text-gray-500 text-sm">Or sign in with </div>
                <div class="w-4/12 bg-gray-200 h-0.5"></div>
            </div>
            <SecondaryButton @click="loginViaGoogle" class="w-full space-x-2 mt-4 md:mt-0 h-12 !rounded-xl !text-sm capitalize">
                    <img src="../../../../public/assets/images/google_logo.png" class="w-4">
                <span>
                  Sign in with Google
              </span>
            </SecondaryButton>
            <SecondaryButton @click="loginViaGoogle" class="w-full space-x-2 mt-4 md:mt-0 h-12 !rounded-xl !text-sm capitalize">
                <img src="../../../../public/assets/images/facebook_logo.png" class="w-4">
                <span>
                  Sign in with Facebook
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
