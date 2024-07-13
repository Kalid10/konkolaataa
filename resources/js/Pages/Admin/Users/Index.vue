<script setup>
import { ref, computed, watch, onMounted } from 'vue';
import { usePage, router } from '@inertiajs/vue3';
import { Table, TableBody, TableRow, TableCell } from '@/Components/shadcn/ui/table/index.js';
import { debounce } from 'lodash';
import { Link } from '@inertiajs/vue3';

const pageData = usePage().props;
const paginatedUsers = ref(pageData.users);

const types = computed(() => ['all', 'buyer', 'seller', 'admin']);
const searchQuery = ref(pageData.search || '');
const filterType = ref(pageData.type || 'all');

const fetchUsers = (url = route('admin.users')) => {
    const params = { search: searchQuery.value, type: filterType.value };
    router.get(url, params, {
        preserveState: true,
        replace: true,
        onSuccess: (page) => {
            paginatedUsers.value = page.props.users;
        }
    });
};

const search = debounce(() => {
    fetchUsers();
}, 300);

watch([searchQuery, filterType], () => {
    search();
});

const filteredUsers = computed(() => {
    return paginatedUsers.value.data.filter(user => {
        return (filterType.value === 'all' || user.type === filterType.value.toLowerCase());
    });
});

onMounted(() => {
    fetchUsers();
});
</script>

<template>
    <div class="min-h-screen bg-white">
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <h1 class="text-3xl font-bold text-gray-900">
                    Manage Users
                </h1>
            </div>
        </header>

        <main class="w-10/12 mx-auto py-6 sm:px-6 lg:px-8">
            <div class="px-4 py-6 sm:px-0">
                <div class="bg-white shadow sm:rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <div class="flex justify-between items-center mb-4">
                            <div>
                                <input
                                    type="text"
                                    v-model="searchQuery"
                                    placeholder="Search users..."
                                    class="border border-gray-300 rounded-md shadow-sm px-3 py-2"
                                />
                                <select
                                    v-model="filterType"
                                    class="ml-2 border border-gray-300 rounded-md shadow-sm px-3 py-2"
                                >
                                    <option v-for="type in types" :key="type" :value="type">{{ type.charAt(0).toUpperCase() + type.slice(1) }}</option>
                                </select>
                            </div>
                            <button
                                @click="router.visit(route('admin.users.register'))"
                                class="bg-blue-500 text-white px-4 py-2 rounded-md"
                            >
                                Add New User
                            </button>
                        </div>
                        <div class="overflow-x-auto">
                            <Table class="min-w-full bg-white shadow rounded-lg">
                                <TableBody class="bg-gray-300 font-semibold">
                                    <TableRow>
                                        <TableCell class="p-4">Name</TableCell>
                                        <TableCell class="p-4">Email/Phone</TableCell>
                                        <TableCell class="p-4">Role</TableCell>
                                    </TableRow>
                                </TableBody>
                                <TableBody>
                                    <TableRow v-for="user in filteredUsers" :key="user.id" class="border-b">
                                        <TableCell class="p-4">
                                          <span>{{ user.name }}</span>
                                        </TableCell>
                                        <TableCell class="p-4">
                                            <span>{{ user.phone_number || user.email }}</span>
                                        </TableCell>
                                        <TableCell class="p-4">{{ user.type.charAt(0).toUpperCase() + user.type.slice(1) }}</TableCell>
                                    </TableRow>
                                    <TableRow v-if="filteredUsers.length === 0">
                                        <TableCell class="p-4 text-center" colspan="4">No users found.</TableCell>
                                    </TableRow>
                                </TableBody>
                            </Table>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</template>

<style scoped>
/* Add any additional styles for the users page */
</style>
