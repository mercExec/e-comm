<template>
    <!-- component -->
    <div class="py-14 px-4 md:px-6 2xl:px-20 2xl:container 2xl:mx-auto bg-white p-8" v-if="order" >
        <!--- more free and premium Tailwind CSS components at https://tailwinduikit.com/ --->

        <div class="flex justify-start item-start space-y-2 flex-col">
            <h1 class="text-3xl dark:text-white lg:text-4xl font-semibold leading-7 lg:leading-9 text-gray-800">Order #{{ order.id }}
            </h1>
            <p class="text-base dark:text-gray-300 font-medium leading-6 text-gray-600">{{ order.created_at }}</p>
        </div>
        <div
            class="mt-10 flex flex-col xl:flex-row jusitfy-center items-stretch w-full xl:space-x-8 space-y-4 md:space-y-6 xl:space-y-0">
            <div class="flex flex-col justify-start items-start w-full space-y-4 md:space-y-6 xl:space-y-8">
                <div class="flex flex-col justify-start items-start py-4 md:py-6 w-full">
                    <p class="text-lg md:text-xl dark:text-white font-semibold leading-6 xl:leading-5 text-gray-800">
                        Customer’s Cart</p>
                    <div class="mt-4 md:mt-6 flex flex-col md:flex-row justify-start items-start md:items-center md:space-x-6 xl:space-x-8 w-full"
                        v-for="(orderProduct, index) in order.order_products" :key="index">
                        <div class="pb-4 md:pb-8 w-full md:w-40 ">
                            <img class="md:block md:w-full md:h-full h-20 w-20" v-if="orderProduct.product.thumbnail"
                                :src="$storage + orderProduct.product.thumbnail.url" alt="dress" />
                        </div>
                        <div
                            class="border-b border-gray-200 md:flex-row flex-col flex justify-between items-start w-full pb-8 space-y-4 md:space-y-0">
                            <div class="w-full flex flex-col justify-start items-start space-y-8">
                                <h3 class="text-xl dark:text-white xl:text-2xl font-semibold leading-6 text-gray-800">
                                    {{ orderProduct.product.title }}</h3>
                            </div>
                            <div class="flex justify-between space-x-8 items-start w-full">
                                <p class="text-base dark:text-white xl:text-lg leading-6">{{ formatCurrency.format(orderProduct.product.price)  }}
                                </p>
                                <p class="text-base dark:text-white xl:text-lg leading-6 text-gray-800">{{
                                    orderProduct.quantity }}</p>
                                <p class="text-base dark:text-white xl:text-lg font-semibold leading-6 text-gray-800">{{
                                    formatCurrency.format(orderProduct.product.price * orderProduct.quantity) }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div
                    class="flex justify-center flex-col md:flex-row items-stretch w-full space-y-4 md:space-y-0 md:space-x-6 xl:space-x-8">
                    <div class="flex flex-col py-6 w-full space-y-6">
                        <h3 class="text-xl dark:text-white font-semibold leading-5 text-gray-800">Summary</h3>
                        <div
                            class="flex justify-center items-center w-full space-y-4 flex-col border-gray-200 border-b pb-4">
                            <div class="flex justify-between w-full">
                                <p class="text-base dark:text-white leading-4 text-gray-800">Subtotal</p>
                                <p class="text-base dark:text-gray-300 leading-4 text-gray-600">{{ formatCurrency.format(order.total) }}</p>
                            </div>
                            <div class="flex justify-between items-center w-full">
                                <p class="text-base dark:text-white leading-4 text-gray-800">Shipping</p>
                                <p class="text-base dark:text-gray-300 leading-4 text-gray-600 line-through">$8.00</p>
                            </div>
                        </div>
                        <div class="flex justify-between items-center w-full">
                            <p class="text-base dark:text-white font-semibold leading-4 text-gray-800">Total</p>
                            <p class="text-base dark:text-gray-300 font-semibold leading-4 text-gray-600">{{ formatCurrency.format(order.total) }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import useProducts from "@/js/composables/products";
import axios from "axios";
import { onBeforeMount, ref } from "vue";

const order = ref(null);

const props = defineProps({
    order: {
        required: true,
        type: String
    }
});

const { formatCurrency } = useProducts();

onBeforeMount(async () => {
    const { data } = await axios.get('/api/orders/' + props.order);
    order.value = data;
})

</script>

<style></style>