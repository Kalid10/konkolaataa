<script setup>

import {Check} from "lucide-vue-next";
import {Tabs, TabsContent, TabsList, TabsTrigger} from "@/Components/shadcn/ui/tabs/index.js";
import PricingCard from "@/Views/PricingCard.vue";
import {ref} from "vue";

const pricingTiers = ref([
    {
        name: 'Basic',
        planName: 'Start',
        description: 'Ideal for personal car sale',
        price: '500Br',
        priceValue: '/ per post',
        features: [
            '40 days post on Konkolata',
            'Post Analytics',
        ],
        bgColor: 'bg-emerald-300',
        textColor: 'text-black',
        borderColor: 'border-black',
        textColorHover: 'hover:text-gray-700',
        buttonColor: 'bg-gray-700',
        tagColor: 'bg-gray-700 text-white',
        iconColor: 'text-black'
    },
    {
        name: 'Pro',
        planName: 'Pro',
        description: 'Ideal for personal car sale',
        price: '1500Br',
        priceValue: '/ per post',
        features: [
            '50 days post on Konkolata',
            '10 Days Smart Featured Post',
            'Post Analytics',
            '2 Free Reposts',
        ],
        bgColor: 'bg-black',
        textColor: 'text-white',
        borderColor: 'border-gray-500',
        textColorHover: 'hover:text-gray-400',
        buttonColor: 'bg-gray-700',
        tagColor: 'bg-slate-700',
        iconColor: 'fill-black stroke-gray-200 text-gray-400'
    },
    {
        name: 'Scale',
        planName: 'Enterprise',
        description: 'Ideal for personal car sale',
        price: '3500Br',
        priceValue: '/ per post',
        features: [
            '60 days post on Konkolata',
            '20 Days Smart Featured Post',
            '2 days Pinned Post',
            'Post Analytics',
            '7 Free Reposts',
        ],
        bgColor: 'bg-indigo-300',
        textColor: 'text-black',
        borderColor: 'border-black',
        textColorHover: 'hover:text-gray-700',
        buttonColor: 'bg-gray-700',
        tagColor: 'bg-gray-700 text-white',
        iconColor: 'text-black'
    }
]);

const subscriptionTiers = ref([
    {
        name: 'Starter',
        planName: 'Starter',
        description: 'Ideal for small brokers',
        price: '2000Br',
        priceValue: '/ per month',
        features: [
            'Up to 5 posts per month',
            'Basic Analytics',
            'Broker Profile Page',
        ],
        bgColor: 'bg-green-300',
        textColor: 'text-black',
        borderColor: 'border-black',
        textColorHover: 'hover:text-gray-700',
        buttonColor: 'bg-gray-700',
        tagColor: 'bg-gray-700 text-white',
        iconColor: 'text-black'
    },
    {
        name: 'Business',
        planName: 'Business',
        description: 'Ideal for growing brokers',
        price: '5000Br',
        priceValue: '/ per month',
        features: [
            'Up to 15 posts per month',
            'Detailed Analytics',
            'Featured Broker Status',
            'Priority Support',
        ],
        bgColor: 'bg-blue-300',
        textColor: 'text-black',
        borderColor: 'border-black',
        textColorHover: 'hover:text-gray-700',
        buttonColor: 'bg-gray-700',
        tagColor: 'bg-gray-700 text-white',
        iconColor: 'text-black'
    },
    {
        name: 'Enterprise',
        planName: 'Enterprise',
        description: 'Ideal for large brokers',
        price: '10000Br',
        priceValue: '/ per month',
        features: [
            'Unlimited posts per month',
            'Comprehensive Analytics',
            'Priority Placement in Search Results',
            'Custom Promotional Campaigns',
            'Dedicated Support',
        ],
        bgColor: 'bg-purple-300',
        textColor: 'text-black',
        borderColor: 'border-black',
        textColorHover: 'hover:text-gray-700',
        buttonColor: 'bg-gray-700',
        tagColor: 'bg-gray-700 text-white',
        iconColor: 'text-black'
    }
]);
</script>

<template>
    <div class="flex flex-col space-y-10 w-full md:w-10/12 mx-auto min-h-screen py-5 md:pt-14">

        <div class="text-center flex flex-col space-y-2">
            <div class="font-semibold text-6xl">Let's Get Started</div>
            <div class="font-light text-xl"> Pick the plan tailored for you!</div>
        </div>
        <Tabs default-value="one_time" class="!flex flex-col items-center !w-full min-w-full h-full">
            <TabsList class="!rounded-full !p-0 border bg-white text-gray-700 border-black">
                <TabsTrigger value="one_time" class="bg-transparent h-full w-full px-5 pl-7 !rounded-l-full space-x-1">
                    <Check class="text-white" size="16"/>
                    <span>OneTime</span>
                </TabsTrigger>
                <TabsTrigger value="subscriptions" class="bg-transparent h-full w-full px-5 pr-7 !rounded-r-full space-x-1">
                    <Check class="text-white" size="16"/>
                    <span>Subscriptions</span>
                </TabsTrigger>
            </TabsList>
            <TabsContent value="one_time" class="w-full pt-5 md:pt-14">
                <slot name="one_time"/>
                <div class="w-full flex flex-col space-y-8 md:space-y-0 md:flex-row justify-evenly">
                    <PricingCard
                        v-for="tier in pricingTiers"
                        :key="tier.name"
                        :tier="tier"
                    />
                </div>
            </TabsContent>
            <TabsContent value="subscriptions" class="w-full pt-5 md:pt-14">
                <slot name="subscriptions"/>
                <div class="w-full flex flex-col space-y-8 md:space-y-0 md:flex-row justify-evenly">
                    <PricingCard
                        v-for="tier in subscriptionTiers"
                        :key="tier.name"
                        :tier="tier"
                    />
                </div>
            </TabsContent>
        </Tabs>

    </div>
</template>

<style scoped>

</style>
