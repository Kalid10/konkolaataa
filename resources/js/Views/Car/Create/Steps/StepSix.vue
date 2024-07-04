<script setup>
import InputLabel from "@/Components/InputLabel.vue";
import { BookText } from "lucide-vue-next";
import {router, useForm} from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {useCreateCar} from "@/Composables/useCreateCar.js";

const { postCar } = useCreateCar();
const form = useForm({
    exteriorImages:  [],
    exteriorImagesPreview:  [],
    interiorImages: [],
    interiorImagesPreview:[],
});

const handleFileChange = (event, isExteriorImage) => {
    const files = event.target.files;
    if (files.length) {
        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            const reader = new FileReader();
            reader.onload = (e) => {
                if (isExteriorImage && file) {
                    form.exteriorImages.push(file);
                    return form.exteriorImagesPreview.push(e.target.result);
                }else{
                    form.interiorImages.push(file);
                    return form.interiorImagesPreview.push(e.target.result);
                }
            };
            reader.readAsDataURL(file);
        }
    }
};

const removeImage = (index, isExteriorImage) => {
    if (isExteriorImage) {
        form.exteriorImages.splice(index, 1);
        return  form.exteriorImagesPreview.splice(index, 1);

    }else{
        form.interiorImages.splice(index, 1);
        return form.interiorImagesPreview.splice(index, 1);
    }
};

function uploadImages(){
    postCar(form.exteriorImages, form.interiorImages);
}

</script>

<template>
    <div class="flex flex-col space-y-8">
        <div class="flex flex-col space-y-4 justify-center">
            <InputLabel>Exterior Car Images</InputLabel>

            <div class="flex flex-wrap space-x-2 mt-4">
                <div
                    v-for="(image, index) in form.exteriorImagesPreview"
                    :key="index"
                    class="relative w-20 h-16 bg-gray-100 rounded overflow-hidden">
                    <img :src="image" alt="Exterior Image" class="w-full h-full object-cover" />
                    <button
                        @click="removeImage(index, true)"
                        class="absolute top-0 bg-red-600 right-0 text-sm w-5 h-5 text-white rounded-full">
                        x
                    </button>
                </div>
            </div>
            <label
                class="flex flex-col space-y-4 border w-full items-center justify-center border-dashed border-indigo-300 rounded-lg h-fit py-3"
                for="exteriorFileInput">
        <span class="p-2 rounded-full bg-indigo-50">
          <BookText class="text-indigo-600" size="18" />
        </span>
                <span>
          <span class="flex flex-col space-y-1">
            <span class="font-medium">Upload Car Exterior Images</span>
            <span class="text-xs font-light">You should upload at least 2 images</span>
          </span>
        </span>
            </label>
            <input
                id="exteriorFileInput"
                type="file"
                class="hidden"
                accept="image/*"
                multiple
                @change="(e) => handleFileChange(e, true)"
            />
        </div>

        <div class="flex flex-col justify-center space-y-2">
            <InputLabel>Interior Car Images</InputLabel>
            <div class="flex flex-wrap space-x-2 mt-4">
                <div
                    v-for="(image, index) in form.interiorImagesPreview"
                    :key="index"
                    class="relative w-20 h-16 bg-gray-100 rounded overflow-hidden">
                    <img :src="image" alt="Interior Image" class="w-full h-full object-cover" />
                    <button
                        @click="removeImage(index, false)"
                        class="absolute top-0 bg-red-600 right-0 text-sm w-5 h-5 text-white rounded-full">
                        x
                    </button>
                </div>
            </div>
            <label
                class="flex flex-col space-y-4 border w-full items-center justify-center border-dashed border-indigo-300 rounded-lg h-fit py-3"
                for="interiorFileInput">
        <span class="p-2 rounded-full bg-indigo-50">
          <BookText class="text-indigo-600" size="18" />
        </span>
                <span>
          <span class="flex flex-col space-y-1">
            <span class="font-medium">Upload Interior Car Images</span>
            <span class="text-xs font-light">You should upload at least 2 images</span>
          </span>
        </span>
            </label>
            <input
                id="interiorFileInput"
                type="file"
                class="hidden"
                accept="image/*"
                multiple
                @change="(e) => handleFileChange(e, false)"
            />

        </div>
        <PrimaryButton @click="uploadImages" class="!bg-gray-800 w-full">Post Car</PrimaryButton>

    </div>
</template>
