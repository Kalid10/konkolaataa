<script setup>
import BottomNavigationItem from "@/Components/BottomNavigationItem.vue";
import {computed} from "vue";
import {usePage} from "@inertiajs/vue3";
import {Warehouse, User, CirclePlusIcon, Home} from "lucide-vue-next";
import Notification from "@/Components/Notification.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const isLoggedIn = computed(() => {
    return usePage().props.auth.user;
});
const user = computed(() => {
    return usePage().props.auth.user;
});
</script>

<template>

    <div class="min-h-screen h-full bg-white">
        <main class="px-3 md:px-6 w-11/12 mx-auto md:w-11/12 bg-white pb-16 md:py-6">
            <div class="flex items-center py-6 justify-between w-full">
                <div class="font-bold text-xl text-brand-primary text-center uppercase">Konkolata</div>
                <div class="flex justify-end w-full space-x-2">
                    <div class="text-xs font-medium items-end justify-center flex flex-col">
                        <span>{{user.name}}</span>
                        <span class="capitalize">{{ user.type }}</span>
                    </div>
                    <img
                        :src="'https://api.dicebear.com/9.x/fun-emoji/svg/seed=' + usePage().props.auth.user.name"
                        alt="avatar"
                        class="w-11 h-11 rounded-md"
                    />
                </div>
            </div>
            <Notification/>
            <slot/>
        </main>
        <div class="fixed right-0 left-0 bottom-0 shadow-lg z-50">
            <div class="flex w-full justify-around  py-2 bg-white  border-t ">
                <BottomNavigationItem class="" :icon="Home" label="Home" to="/"
                                      :active="route().current('cars.index') || route().current('home')"/>
                <BottomNavigationItem class="" v-if="isLoggedIn" :icon="CirclePlusIcon" label="My Posts" to="/car/post"
                                      :active="route().current('cars.create')"/>
                <BottomNavigationItem class="" :icon="User" label="Profile" to="/profile"
                                      :active="route().current('profile.edit')"/>
            </div>
        </div>
    </div>
</template>

<style>
</style>
