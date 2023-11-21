<template>
    <div class="bg-gray-100 h-screen">
        <div class="bg-white p-6  md:mx-auto">
            <svg class="w-16 h-16 mx-auto my-6" fill="#dc2626" viewBox="0 -8 528 528" xmlns="http://www.w3.org/2000/svg" style="--darkreader-inline-fill: #761212; --darkreader-inline-stroke: #761212;" data-darkreader-inline-fill="" stroke="#dc2626" data-darkreader-inline-stroke=""><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M264 456Q210 456 164 429 118 402 91 356 64 310 64 256 64 202 91 156 118 110 164 83 210 56 264 56 318 56 364 83 410 110 437 156 464 202 464 256 464 310 437 356 410 402 364 429 318 456 264 456ZM264 288L328 352 360 320 296 256 360 192 328 160 264 224 200 160 168 192 232 256 168 320 200 352 264 288Z"></path></g></svg>            <div class="text-center">
                <h3 class="md:text-2xl text-base text-gray-900 font-semibold text-center">Payment Failed!</h3>
                <p class="text-gray-600 my-2">Your online payment has failed for some reason. You can try again by visiting
                    your order history and repeating your payment. </p>
                <div class="py-10 text-center">
                    <router-link :to="{ name: 'home' }"
                        class="px-12 bg-indigo-600 hover:bg-indigo-500 text-white font-semibold py-3">
                        GO BACK
                    </router-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { useCartStore } from "@/js/stores/cart";
import axios from "axios";
import { onBeforeMount, onMounted } from "vue";

const cart = useCartStore();

onBeforeMount(async () => {
    await cart.resetCart();
})

onMounted(async () => {
    // const {data} = await axios.get('/api/checkout/failure');
    // console.log(data);
})
</script>

<style></style>