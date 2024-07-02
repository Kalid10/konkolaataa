<script setup>

import InputLabel from "@/Components/InputLabel.vue";
import {BookText} from "lucide-vue-next";

</script>

<template>
    <div class="flex flex-col space-y-8">
        <div class="flex flex-col space-y-4 justify-center">
            <InputLabel>Exterior Car Images</InputLabel>
            <label
                class="flex flex-col space-y-4 border w-full items-center justify-center border-dashed border-indigo-300 rounded-lg h-40"
                for="fileInput">
                <span class="p-2 rounded-full bg-indigo-50">
                    <BookText class="text-indigo-600" size="18"/>
                </span>
                <span>

                    <span class="flex flex-col space-y-1">

                <span class=" font-medium">
                    Upload Car Exterior Images
                </span>
                <span class="text-xs font-light">
                    You should upload at least 2 images
                    </span>
                </span>
                </span>
            </label>
            <input
                id="fileInput"
                type="file"
                class="hidden"
                accept="image/*"
            />
        </div>


        <div class="flex flex-col justify-center space-y-2">
            <InputLabel>Interior Car Images</InputLabel>
            <label
                class="flex flex-col space-y-4 border w-full items-center justify-center border-dashed border-indigo-300 rounded-lg h-40"
                for="fileInput">
                <span class="p-2 rounded-full bg-indigo-50">
                    <BookText class="text-indigo-600" size="18"/>
                </span>
                <span>

                    <span class="flex flex-col space-y-1">

                <span class=" font-medium">
                    Upload Interior Car Images
                </span>
                <span class="text-xs font-light">
                    You should upload at least 2 images
                    </span>
                </span>
                </span>
            </label>
            <input
                id="fileInput"
                type="file"
                class="hidden"
                accept="image/*"
            />
        </div>
    </div>
</template>

<style scoped>

</style>
