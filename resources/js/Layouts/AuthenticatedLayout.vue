<script setup>
import {provide, ref} from 'vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import Notification from "@/Components/Notification.vue";
import Navbar from "@/Components/Navbar.vue";

const notificationData = ref(null);

const showNotification = (data) => {
    notificationData.value = data;
};

provide("showNotification", showNotification);
provide("notificationData", notificationData);

</script>

<template>
    <div>
        <div class="min-h-screen bg-white">
           <Navbar/>

            <!-- Page Heading -->
            <header class="bg-white shadow" v-if="$slots.header">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header>

            <!-- Page Content -->
            <main class="px-3 md:px-6 w-11/12 mx-auto md:w-11/12 bg-white py-3 md:py-6">
                <Notification />
                <slot />
            </main>
        </div>
    </div>
</template>

<style>
.hide-scrollbar::-webkit-scrollbar {
    display: none; /* for Chrome, Safari, and Opera */
}

.hide-scrollbar {
    -ms-overflow-style: none; /* for Internet Explorer and Edge */
    scrollbar-width: none; /* for Firefox */
}
</style>
