<template>
    <!-- component -->
    <div class="bg-white px-4 sm:p-8 rounded-md container mx-auto">
        <div class=" flex items-center justify-between pb-6">
            <div class="flex items-center justify-between">
                <!-- <div class="flex bg-gray-50 items-center p-2 rounded-md">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                            clip-rule="evenodd" />
                    </svg>
                    <input class="bg-gray-50 outline-none ml-1 block " type="text" name="" id="" placeholder="search...">
                </div> -->
            </div>
        </div>
        <div>
            <div class="-mx-4 sm:-mx-8 sm:px-8 py-4 overflow-x-auto">
                <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                    <table class="min-w-full leading-normal table-auto">
                        <thead>
                            <tr>
                                <th
                                    class="sm:pl-5 py-3 border-b-2 border-gray-200 bg-gray-100 sm:text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Order #
                                </th>
                                <th
                                    class="py-3 border-b-2 border-gray-200 bg-gray-100 sm:text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Created at
                                </th>
                                <th
                                    class="py-3 border-b-2 border-gray-200 bg-gray-100 sm:text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    <p class="w-10">Status</p>

                                </th>
                                <th
                                    class="py-3 border-b-2 border-gray-200 bg-gray-100 sm:text-left text-xs font-semibold text-gray-600 uppercase tracking-wider sm:block hidden">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(order, index) in orders.data" :key="index">
                                <td class="sm:pl-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <div class="flex items-center ">
                                        <div class="ml-3">
                                            <p class="text-gray-900 ">
                                                {{ order.id }}
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class=" py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 w-10">
                                        {{ order.created_at }}
                                    </p>
                                </td>
                                <td class=" py-5 border-b border-gray-200 bg-white text-sm">
                                    <span class="relative inline-block px-3 py-1 font-semibold leading-tight"
                                        :class="order.status == 'Pending' ? 'text-orange-900' : order.status == 'Failed' ? 'text-red-900' : 'text-green-900'">
                                        <span aria-hidden class="absolute inset-0 opacity-50 rounded-full"
                                            :class="order.status == 'Pending' ? 'bg-orange-200' : order.status == 'Failed' ? 'bg-red-200' : 'bg-green-200'"></span>
                                        <span class="relative">{{ order.status }}</span>
                                    </span>
                                    <div class="sm:hidden block py-2 w-10">
                                        <router-link :to="{ name: 'showOrder', params: { order: order.id } }">
                                            <button type="button"
                                                class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">View
                                                Summary
                                            </button>
                                        </router-link>
                                        <form @submit.prevent="payOrder(order.id)" v-if="order.status == 'Pending'">
                                            <button
                                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Pay</button>
                                        </form>
                                    </div>
                                </td>
                                <td class=" py-5 border-b border-gray-200 bg-white text-sm sm:block hidden">

                                    <div class="flex">
                                        <router-link :to="{ name: 'showOrder', params: { order: order.id } }">
                                            <button type="button"
                                                class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">View
                                                Summary
                                            </button>
                                        </router-link>
                                        <form @submit.prevent="payOrder(order.id)" v-if="order.status == 'Pending'">
                                            <button
                                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Pay</button>
                                        </form>
                                    </div>
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

const list = async (page = 1) => {
    await axios.get(`/api/orders?page=${page}`).then(({ data }) => {
        orders.value = data;
    }).catch(({ response }) => {
        console.error(response)
    })
}

const payOrder = async (orderId) => {
    await axios.post('/api/checkout/' + orderId)
        .then(
            res => {
                window.location.replace(res.data);
            }
        )
        .catch(
            err => {
                console.log(err);
            }
        );

}

onMounted(async () => {
    list();
})
</script>

<style></style>