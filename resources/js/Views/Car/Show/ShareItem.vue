<script setup>

import {Facebook, Instagram, MessageSquareText, Paperclip, Send} from "lucide-vue-next";
import InputLabel from "@/Components/InputLabel.vue";
</script>

<template>
    <div class="flex flex-col space-y-1 md:w-fit  py-5">
        <InputLabel class="px-1 md:text-center">Share</InputLabel>
        <div class="flex items-center justify-between  space-x-5 md:space-x-8 py-2 px-2 text-brand-primary">
            <Paperclip/>
            <Facebook/>
            <MessageSquareText/>
            <Instagram/>
            <Send/>
        </div>
    </div>
</template>

<style scoped>

</style>
