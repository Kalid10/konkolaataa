<script setup>
import { ref } from 'vue';
import DashboardCard from '@/Views/Admin/Dashboard/DashboardCard.vue';
import RecentActivity from '@/Views/Admin/Dashboard/RecentActivity.vue';
import TopPerformingUsers from '@/Views/Admin/Dashboard/TopPerformingUsers.vue';
import NewListings from '@/Views/Admin/Dashboard/NewListings.vue';
import PopularCarModels from '@/Views/Admin/Dashboard/PopularCarModels.vue';
import PendingApprovals from '@/Views/Admin/Dashboard/PendingApprovals.vue';

// Mock data
const stats = ref({
    users: 1500,
    sales: 3000,
    revenue: 50000,
    newUsers: 150
});

const recentActivities = ref([
    { id: 1, description: 'User John Doe registered', time: '2 hours ago' },
    { id: 2, description: 'User Jane Smith purchased a car', time: '3 hours ago' },
    { id: 3, description: 'Admin updated car listing', time: '1 day ago' },
    // Add more activities
]);

const topUsers = ref([
    { id: 1, name: 'John Doe', sales: 15 },
    { id: 2, name: 'Jane Smith', sales: 12 },
    { id: 3, name: 'Michael Brown', sales: 10 },
    // Add more users
]);

const newListings = ref([
    { id: 1, title: '2021 Toyota Camry', date: '2024-07-10', price: '$25,000' },
    { id: 2, title: '2019 Honda Accord', date: '2024-07-11', price: '$22,000' },
    { id: 3, title: '2020 Ford Mustang', date: '2024-07-12', price: '$30,000' },
    // Add more listings
]);

const popularCarModels = ref([
    { id: 1, model: 'Toyota Camry', searches: 120},
    {id: 2, model: 'Honda Accord', searches: 100},
    {id: 3, model: 'Ford Mustang', searches: 80},
    // Add more models
]);

const pendingApprovals = ref([
    {id: 1, type: 'Listing', detail: '2021 Toyota Camry', date: '2024-07-10'},
    {id: 2, type: 'User Registration', detail: 'John Doe', date: '2024-07-11'},
    {id: 3, type: 'Listing', detail: '2019 Honda Accord', date: '2024-07-12'},
    // Add more approvals
]);
</script>

<template>
    <div class="min-h-screen w-10/12 mx-auto py-6 sm:px-6 lg:px-8 rounded">
        <div class="px-4 py-6 sm:px-0">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                <DashboardCard title="Total Users" :value="stats.users" icon="users"/>
                <DashboardCard title="Total Sales" :value="stats.sales" icon="shopping-cart"/>
                <DashboardCard title="Total Revenue" :value="stats.revenue" icon="dollar-sign"/>
                <DashboardCard title="New Users" :value="stats.newUsers" icon="user-plus"/>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                <TopPerformingUsers :users="topUsers"/>
                <NewListings :listings="newListings"/>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                <PopularCarModels :models="popularCarModels"/>
                <PendingApprovals :approvals="pendingApprovals"/>
            </div>

            <div class="bg-white shadow sm:rounded-lg mb-6">
                <div class="px-4 py-5 sm:p-6">
                    <h2 class="text-xl font-semibold mb-4">Recent Activity</h2>
                    <RecentActivity :activities="recentActivities"/>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
/* Add any additional styles for the dashboard page */
</style>
