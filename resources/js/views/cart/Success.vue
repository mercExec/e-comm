<template>
    <!-- component -->
<div class="bg-gray-100 h-screen" v-if="checkoutSession">
      <div class="bg-white p-6  md:mx-auto">
        <svg viewBox="0 0 24 24" class="text-green-600 w-16 h-16 mx-auto my-6">
            <path fill="currentColor"
                d="M12,0A12,12,0,1,0,24,12,12.014,12.014,0,0,0,12,0Zm6.927,8.2-6.845,9.289a1.011,1.011,0,0,1-1.43.188L5.764,13.769a1,1,0,1,1,1.25-1.562l4.076,3.261,6.227-8.451A1,1,0,1,1,18.927,8.2Z">
            </path>
        </svg>
        <div class="text-center">
            <h3 class="md:text-2xl text-base text-gray-900 font-semibold text-center">Payment Done!</h3>
            <p class="text-gray-600 my-2">Thank you for completing your secure online payment.</p>
            <p> Have a great day!  </p>
            <div class="py-10 text-center">
                <router-link :to="{name: 'home' }" class="px-12 bg-indigo-600 hover:bg-indigo-500 text-white font-semibold py-3">
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
import { onBeforeMount, ref } from "vue";
import { useRoute, useRouter } from "vue-router";

const route = useRoute();
const router = useRouter();
const checkoutSession = ref('');
const cart = useCartStore();

onBeforeMount(async () => {
    try {
        const session_id = route.query.session_id;

        if (!session_id) {
            router.push({ name: 'cartIndex' });
        }

        await cart.resetCart();
        const { data } = await axios.get('/api/checkout/success?session_id=' + session_id);

        if (!data) {
            router.push({ name: 'checkoutFailure' });
        }

        checkoutSession.value = data;
    } catch (error) {
        router.push({ name: 'checkoutFailure' });
    }
})

</script>

<style>

</style>