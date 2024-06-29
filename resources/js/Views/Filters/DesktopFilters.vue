<script setup>

import {Tabs, TabsContent, TabsList, TabsTrigger} from "@/Components/shadcn/ui/tabs/index.js";
import {Check} from "lucide-vue-next";
</script>

<template>
    <Tabs default-value="used" class=" !flex flex-col items-center min-w-full h-full ">
        <TabsList class="!rounded-full !p-0 border bg-white text-gray-700 border-black">
            <TabsTrigger value="used" class="bg-transparent h-full w-full px-5 pl-7 !rounded-l-full space-x-1">
               <Check class="text-white" size="16"/>
                <span>Used Cars</span>
            </TabsTrigger>
            <TabsTrigger value="new" class="bg-transparent h-full w-full px-5 pr-7 !rounded-r-full space-x-1">
                <Check class="text-white" size="16"/>
                <span>New Cars</span>
            </TabsTrigger>
        </TabsList>
        <TabsContent value="used">
            <slot name="used_tab"/>
        </TabsContent>
        <TabsContent value="new">
            <slot name="new_tab"/>
        </TabsContent>
    </Tabs>
</template>

<style scoped>

</style>
