<template>
    <div wire:loading
        class="fixed top-0 left-0 right-0 bottom-0 w-full h-screen z-50 overflow-hidden bg-gray-700 opacity-75 flex flex-col items-center justify-center"
        v-if="isUpdatingStatus">
        <div class="loader ease-linear rounded-full border-4 border-t-4 border-gray-200 h-12 w-12 mb-4"></div>
        <h2 class="text-center text-white text-xl font-semibold">Loading...</h2>
        <p class="w-1/3 text-center text-white">This may take a few seconds, please don't close this page.</p>
    </div>
    <div class="flex flex-col">
        <div class="overflow-x-auto">
            <div class="inline-block min-w-full align-middle">
                <div class="overflow-hidden shadow">
                    <table class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-600">
                        <thead class="bg-gray-100 dark:bg-gray-700">
                            <tr>
                                <th scope="col"
                                    class="sm:p-4 px-0 py-4 text-xs font-medium sm:text-left text-gray-500 uppercase dark:text-gray-400">
                                    Order #
                                </th>
                                <th scope="col"
                                    class="sm:p-4 px-0 py-4 text-xs font-medium sm:text-left text-gray-500 uppercase dark:text-gray-400">
                                    Created at
                                </th>
                                <th scope="col"
                                    class="sm:p-4 px-0 py-4 text-xs font-medium sm:text-left text-gray-500 uppercase dark:text-gray-400">
                                    Status
                                </th>
                                <th scope="col"
                                    class="sm:p-4 px-0 py-4 text-xs font-medium sm:text-left text-gray-500 uppercase dark:text-gray-400 hidden lg:block">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700"
                            v-if="orders.data ? true : false">
                            <tr class="hover:bg-gray-100 dark:hover:bg-gray-700" v-for="(order, index) in orders.data"
                                :key="index">
                                <td
                                    class=" w-10 sm:p-4 py-4 px-0 text-base font-medium text-gray-900 break-normal dark:text-white">
                                    <p class="text-gray-900 ">
                                        {{ order.id }}
                                    </p>

                                </td>
                                <td
                                    class="sm:p-4 py-4 px-0 text-base font-normal text-gray-500 break-normal dark:text-gray-400">
                                    <p class="text-gray-900 min-[0px]:max-sm:w-10">
                                        {{ order.created_at }}
                                    </p>
                                </td>
                                <td
                                    class="sm:p-4 py-4 px-0 text-base font-medium text-gray-900 break-normal dark:text-white">
                                    <select @change="updateStatus($event, order.id)" :disabled="isUpdatingStatus"
                                        class="w-18 p-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option value="Pending" :selected="order.status == 'Pending'">Pending</option>
                                        <option value="Completed" :selected="order.status == 'Completed'">Completed</option>
                                        <option value="Failed" :selected="order.status == 'Failed'">Failed</option>
                                    </select>
                                    <router-link :to="{ name: 'admin.showOrder', params: { order: order.id } }"
                                        class="lg:hidden block pt-2">
                                        <button
                                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-adminPrimary-700 hover:bg-adminPrimary-800 focus:ring-4 focus:ring-adminPrimary-300 dark:bg-adminPrimary-600 dark:hover:bg-adminPrimary-700 dark:focus:ring-adminPrimary-800">
                                            View Summary
                                        </button>
                                    </router-link>

                                </td>

                                <td class="sm:p-4 py-4 px-0 space-x-2 break-normal hidden lg:block">
                                    <router-link :to="{ name: 'admin.showOrder', params: { order: order.id } }">
                                        <button
                                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-adminPrimary-700 hover:bg-adminPrimary-800 focus:ring-4 focus:ring-adminPrimary-300 dark:bg-adminPrimary-600 dark:hover:bg-adminPrimary-700 dark:focus:ring-adminPrimary-800">
                                            View Summary
                                        </button>
                                    </router-link>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                    <div class="px-5 py-5 bg-white border-t flex flex-col xs:flex-row xs:justify-between">
                        <TailwindPagination :data="orders" @pagination-change-page="list"></TailwindPagination>
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import axios from "axios";
import { onMounted, ref } from "vue";
import { TailwindPagination } from 'laravel-vue-pagination';

const orders = ref({});
const isUpdatingStatus = ref(false);

const list = async (page = 1) => {
    await axios.get(`/api/admin/orders?page=${page}`).then(({ data }) => {
        orders.value = data;
    }).catch(({ response }) => {
        console.error(response)
    })
}

const updateStatus = async (event, orderId) => {
    isUpdatingStatus.value = true;
    let data = new FormData();
    data.append('orderStatus', event.target.value);
    // Call backend to update status
    await axios.post('/api/admin/orders/update/' + orderId, data)
        .then((res) => {
            isUpdatingStatus.value = false;
            console.log(res.data);
        })
        .catch((err) => {
            console.log(err);
        });
    // This is to simulate a backend call
    // setTimeout(() => {
    //     isUpdatingStatus.value = false;
    // }, 1500);
}

onMounted(async () => {
    list();
})
</script>

<style></style>