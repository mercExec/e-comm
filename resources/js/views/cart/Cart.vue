<template>
    <section class="bg-[#fafafa] pb-24" >
        <div class="container mx-auto">
            <div wire:loading class="fixed top-0 left-0 right-0 bottom-0 w-full h-screen z-50 overflow-hidden bg-gray-700 opacity-75 flex flex-col items-center justify-center" v-if="loadingStripe">
	<div class="loader ease-linear rounded-full border-4 border-t-4 border-gray-200 h-12 w-12 mb-4"></div>
	<h2 class="text-center text-white text-xl font-semibold">Loading...</h2>
	<p class="w-1/3 text-center text-white">This may take a few seconds, please don't close this page.</p>
</div>
            <h2 class="mb-12 flex items-center text-2xl font-semibold text-black sm:text-3xl md:text-4xl">
                Shopping cart
                <span class="pl-5 pt-3 text-lg text-body-color"> {{ cart.getNumberOfProducts() }} Item(s) </span>
            </h2>

            <div class="-mx-4 flex flex-wrap" v-if="cart.getNumberOfProducts() > 0">
                <div class="w-full px-4 xl:w-8/12">
                    <div class="mb-10 max-w-full overflow-x-auto rounded-xl border border-[#e7e7e7] bg-white">
                        <table class="w-full table-auto">
                            <thead>
                                <tr class="bg-white text-left">
                                    <th class="sm:min-w-[300px] min-w-[150] py-4 px-4 text-base font-semibold text-dark xl:pl-9">
                                        Product
                                    </th>
                                    <th class=" py-4 px-4 text-base font-semibold text-dark">
                                        Price
                                    </th>
                                    <th class=" py-4 px-4 text-base font-semibold text-dark">
                                        Quantity
                                    </th>

                                    <!-- <th
                                        class=" py-4 px-4 text-center text-base font-semibold text-dark xl:pr-9">
                                        Remove
                                    </th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(cartProduct, index) in cart.cart" :key="index">
                                    <td class="border-t border-stroke p-4 xl:pl-11 pr-1">
                                        <div class="sm:flex items-center">
                                            <img
                                                v-if="cartProduct.product.thumbnail || cartProduct.product.images"
                                                :src="$storage + cartProduct.product.thumbnail.url"
                                                alt="image" class="mr-4 h-[100px] w-[100px] rounded-lg object-contain">
                                                <h5 class="md:text-lg text-sm font-semibold text-dark  mt-4 sm:mt-0">
                                                    <router-link :to="{name: 'showProduct', params: { product: cartProduct.product.slug }}" class="hover:text-primary">
                                                        {{ cartProduct.product.title }}
                                                    </router-link>
                                                </h5>
                                        </div>
                                    </td>
                                    <td class="border-t border-stroke p-4 pr-1">
                                        <p class="md:text-lg text-sm font-semibold text-black">{{ formatCurrency.format(cartProduct.product.price *
                                    cartProduct.quantity) }}</p>
                                    </td>
                                    <td class="border-t border-stroke p-4 pr-1">
                                        <div class="inline-flex items-center border border-[#e7e7e7] text-base font-medium text-black">
                                            <span @click=" cartProduct.quantity > 1 ? cartProduct.quantity-- : ''; cart.handleQuantityChange(cartProduct.id, index, auth.user ? 'db' : 'cookie')" v-if="!cart.isUpdatingQuantity"
                                                class="cursor-pointer select-none border-r border-[#e7e7e7] md:py-[6px] py-[1px] md:px-4 px-2">
                                                -
                                            </span>
                                            <input
                                                type="number"
                                                min="1" :id="'product_quantity_' + index" v-model.number="cartProduct.quantity"
                                                v-bind="cartProduct.quantity"
                                                @input="cart.handleQuantityChange(cartProduct.id, index, auth.user ? 'db' : 'cookie')"
                                                :disabled="cart.isUpdatingQuantity" class="py-[6px] px-2 w-8 text-center"
                                            />
                                            <span
                                                @click="cartProduct.quantity++; cart.handleQuantityChange(cartProduct.id, index, auth.user ? 'db' : 'cookie')" v-if="!cart.isUpdatingQuantity"
                                                class="cursor-pointer select-none border-l border-[#e7e7e7] md:py-[6px] py-[1px] md:px-4 px-2">
                                                +
                                            </span>
                                        </div>
                                        <button class="text-red-600 pt-1 sm:pl-2 pl-7 " @click.prevent="auth.user ? cart.deleteProductFromDB(cartProduct.id, index) : cart.deleteProductFromCookie(index)">
                                            <svg width="16" height="20" viewBox="0 0 16 20" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M13.8438 2.6875H10.8125V1.5625C10.8125 0.90625 10.2812 0.375 9.625 0.375H6.375C5.71875 0.40625 5.1875 0.90625 5.1875 1.5625V2.6875H2.15625C1.5 2.6875 0.96875 3.21875 0.96875 3.875V6.15625C0.96875 6.46875 1.21875 6.71875 1.53125 6.71875H2V17.3125C2 18.5938 3.0625 19.6563 4.34375 19.6563H11.6875C12.9688 19.6563 14.0312 18.5938 14.0312 17.3125V6.65625H14.5C14.8125 6.65625 15.0625 6.40625 15.0625 6.09375V3.8125C15 3.1875 14.5 2.6875 13.8438 2.6875ZM6.28125 1.5625C6.28125 1.53125 6.3125 1.46875 6.375 1.46875H9.625C9.65625 1.46875 9.71875 1.5 9.71875 1.5625V2.6875H6.28125V1.5625ZM2.09375 3.84375C2.09375 3.8125 2.125 3.75 2.1875 3.75H5.78125H10.2812H13.875C13.9062 3.75 13.9688 3.78125 13.9688 3.84375V5.5625H2.09375V3.84375ZM12.9062 17.2813C12.9062 17.9688 12.3438 18.5313 11.6562 18.5313H4.34375C3.65625 18.5313 3.09375 17.9688 3.09375 17.2813V6.65625H12.9375V17.2813H12.9062Z"
                                                    fill="currentColor"></path>
                                                <path
                                                    d="M8 15.0938C8.3125 15.0938 8.5625 14.8438 8.5625 14.5313V10.4375C8.5625 10.125 8.3125 9.875 8 9.875C7.6875 9.875 7.4375 10.125 7.4375 10.4375V14.5625C7.46875 14.875 7.6875 15.0938 8 15.0938Z"
                                                    fill="currentColor"></path>
                                                <path
                                                    d="M10.625 15.0938C10.9375 15.0938 11.1875 14.8438 11.1875 14.5313V10.4375C11.1875 10.125 10.9375 9.875 10.625 9.875C10.3125 9.875 10.0625 10.125 10.0625 10.4375V14.5625C10.0938 14.875 10.3438 15.0938 10.625 15.0938Z"
                                                    fill="currentColor"></path>
                                                <path
                                                    d="M5.375 15.0938C5.6875 15.0938 5.9375 14.8438 5.9375 14.5313V10.4375C5.9375 10.125 5.6875 9.875 5.375 9.875C5.0625 9.875 4.8125 10.125 4.8125 10.4375V14.5625C4.8125 14.875 5.0625 15.0938 5.375 15.0938Z"
                                                    fill="currentColor"></path>
                                            </svg>
                                        </button>
                                    </td>

                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="w-full px-4 lg:w-1/2 xl:w-4/12">
                    <div class="mb-8 overflow-hidden rounded-xl border border-[#e7e7e7] bg-white py-6 px-6 xs:px-8">
                        <div class="mb-6">
                            <h3 class="mb-2 text-lg font-semibold text-black sm:text-xl">
                                Apply Coupon
                            </h3>
                            <p class="text-sm font-medium text-body-color">
                                Using A Promo Code?
                            </p>
                        </div>

                        <form class="items-center xs:flex" @submit.prevent="">
                            <input type="text" placeholder="Coupon code"
                                class="mb-3 flex h-10 w-full items-center rounded border border-form-stroke px-6 text-sm font-medium text-body-color outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-[#F5F7FD] xs:mr-4">
                            <button
                                class="mb-3 h-10 rounded bg-primary px-5 text-sm font-semibold text-white transition hover:bg-opacity-90">
                                Apply
                            </button>
                        </form>
                    </div>

                    <div class="mb-8 overflow-hidden rounded-xl border border-[#e7e7e7] bg-white py-6 px-6 xs:px-8">
                        <div class="border-b border-[#e7e7e7] pb-5">
                            <h3 class="text-lg font-semibold text-black sm:text-xl">
                                Total
                            </h3>
                        </div>
                        <div class="-mx-1 border-b border-[#e7e7e7] py-7">
                            <div class="mb-3 flex items-center justify-between">
                                <div class="px-1">
                                    <p class="text-base font-semibold text-black">Total</p>
                                </div>
                                <div class="px-1">
                                    <p class="text-base font-semibold text-black">{{ formatCurrency.format(cart.cartTotalPrice()) }}</p>
                                </div>
                            </div>
                            <div class="mb-3 flex items-center justify-between">
                                <div class="px-1">
                                    <p class="text-base font-medium text-black">Delivery</p>
                                </div>
                                <div class="px-1">
                                    <p class="text-base font-semibold text-black line-through">$14.00</p>
                                </div>
                            </div>
                        </div>
                        <div class="-mx-1 flex items-center justify-between pt-5 pb-6">
                            <div class="px-1">
                                <p class="text-base font-medium text-black">Subtotal</p>
                            </div>
                            <div class="px-1">
                                <p class="text-base font-semibold text-black">{{ formatCurrency.format(cart.cartTotalPrice()) }}</p>
                            </div>
                        </div>

                        <div class="mb-5">
                            <button @click.prevent="submit" v-if="auth.user"
                                class="flex w-full items-center justify-center rounded-md bg-primary py-[10px] px-10 text-center text-base font-normal text-white hover:bg-opacity-90">
                                Checkout
                            </button>
                            <button v-else
                            class="flex w-full items-center justify-center rounded-md bg-primary py-[10px] px-10 text-center text-base font-normal text-white hover:bg-opacity-90">
                            <router-link :to="{name: 'login'}">
                                    You must login to checkout
                                </router-link>
                            </button>

                        </div>
                        <p class="mb-4 text-base font-medium text-body-color">
                            We Accept:
                        </p>
                        <img src="https://demo.tailgrids.com/templates/planet/build/src/assets/ecom-images/shopping-carts/shopping-cart-03/payment.svg" alt="payment">
                    </div>
                </div>
            </div>

            <h1 class="py-24 font-bold text-2xl text-center" v-else>
            Your cart is empty. Products you add to your cart will be shown here.

            </h1>

        </div>
    </section>

</template>
<script setup>
import { useCartStore } from "@/js/stores/cart";
import { onMounted, ref } from "vue";
import { useAuthStore } from "../../stores/auth";
import axios from 'axios';
import useProducts from "@/js/composables/products";

const loadingStripe = ref(false);

const auth = useAuthStore();
const cart = useCartStore();

const { formatCurrency } = useProducts();

const submit = async () => {
    loadingStripe.value = true;
    await getSession(cart.cart);
}

const getSession = async () => {
    const data = new FormData();
    data.append('cartProducts', JSON.stringify(cart.cart));
    await axios.post('/api/checkout', data)
        .then(
            res => {
                window.location.replace(res.data);
            }
        )
        .catch(
            err => {

            }
        );
}

onMounted(async () => {
    cart.getAllProducts();
    cart.resetUpdate();
})
</script>

<style>

input[type='number']::-webkit-outer-spin-button,
input[type='number']::-webkit-inner-spin-button,
input[type='number'] {
    -webkit-appearance: none;
    margin: 0;
    -moz-appearance: textfield !important;
}

.loader {
    border-top-color: #3498db;
    -webkit-animation: spinner 1.5s linear infinite;
    animation: spinner 1.5s linear infinite;
}

@-webkit-keyframes spinner {
    0% {
        -webkit-transform: rotate(0deg);
    }

    100% {
        -webkit-transform: rotate(360deg);
    }
}

@keyframes spinner {
    0% {
        transform: rotate(0deg);
    }

    100% {
        transform: rotate(360deg);
    }
}</style>