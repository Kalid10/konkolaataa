<script setup>
import InputLabel from "@/Components/InputLabel.vue";
import { XCircle, Plus } from "lucide-vue-next";
import {router, useForm} from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {useCreateCar} from "@/Composables/useCreateCar.js";
import Loading from "@/Components/Loading.vue";
import {ref} from "vue";

const { carFormData, clearData, updateCurrentStep } = useCreateCar();
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

const isLoading = ref(false);
const errorMessages = ref([]);
function uploadImages(){
    isLoading.value = true;
    errorMessages.value = [];
    const carData = Object.assign(
        {},
        carFormData.value.stepOne,
        carFormData.value.stepTwo,
        carFormData.value.stepThree,
        carFormData.value.stepFour,
        carFormData.value.stepSix,
        { user_id: carFormData.value.user_id },
        { exteriorCarImages: form.exteriorImages },
        { interiorCarImages: form.interiorImages },
        {carId: carFormData.value.carId}
    );
    router.post('/car/store', carData,{
        onSuccess: () => {
            // clearData();
            // form.reset();
            updateCurrentStep(1);
        },
        onError:(e) => {
            errorMessages.value = Object.values(e).flat();
            },
        onFinish: () => {
            isLoading.value = false;
        }
    });
}

</script>

<template>
    <Loading v-if="isLoading" is-full-screen />
    <div class="flex flex-col space-y-8">
        <div class="bg-red-600 text-white text-xs text-center  flex flex-col space-y-1 p-2 rounded-md" v-if="errorMessages.length">
           <div class="flex space-x-1 justify-center items-center py-1">
               <XCircle class="text-white" size="18"/>
            <span class="font-semibold text-base text-center">Error</span>
           </div>
                <span v-for="(message, index) in errorMessages" :key="index">* {{ message }}</span>
        </div>
        <div class="flex flex-col space-y-2 justify-center">
            <div class="flex flex-col space-y-1">
                <InputLabel>Exterior Car Images</InputLabel><div class="text-xs font-light">You should at least add 2 photos.</div>
            </div>

            <label
                class="flex items-center space-x-2"
                for="exteriorFileInput">
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


                <span class="cursor-pointer hover:scale-110 hover:bg-indigo-200 h-16 mt-4 w-12 rounded-lg flex items-center justify-center bg-indigo-50">
                    <Plus size="20"/>
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

        <div class="flex flex-col space-y-2 justify-center">
            <div class="flex flex-col space-y-1">
                <InputLabel>Interior Car Images</InputLabel><div class="text-xs font-light">You should at least add 1 photos.</div>
            </div>

            <label
                class="flex items-center space-x-2"
                for="interiorFileInput">
                <div class="flex flex-wrap space-x-2 mt-4">
                    <div
                        v-for="(image, index) in form.interiorImagesPreview"
                        :key="index"
                        class="relative w-20 h-16 bg-gray-100 rounded overflow-hidden">
                        <img :src="image" alt="Exterior Image" class="w-full h-full object-cover" />
                        <button
                            @click="removeImage(index, false)"
                            class="absolute top-0 bg-red-600 right-0 text-sm w-5 h-5 text-white rounded-full">
                            x
                        </button>
                    </div>
                </div>


                <span class="cursor-pointer hover:scale-110 hover:bg-indigo-200 h-16 mt-4 w-12 rounded-lg flex items-center justify-center bg-indigo-50">
                    <Plus size="20"/>
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
        <PrimaryButton :disable="form.exteriorImages.length < 3 && form.interiorImages.length < 1" :class="form.exteriorImages.length < 3 && form.interiorImages.length < 1 ? 'opacity-60':'opacity-100'" @click="uploadImages">Post Car</PrimaryButton>

    </div>
</template>
