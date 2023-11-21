<template>
    <!-- Header -->
    <section class="py-10 z-10">
        <div class="container mx-auto">
            <div class="-mx-4 flex flex-wrap ">
                <div class="w-full px-4 lg:w-8/12">
                    <div class="relative mb-8 h-[370px] md:h-[480px]">
                        <img src="https://demo.tailgrids.com/templates/planet/build/src/assets/ecom-images/headers/header-04/image-01.jpg"
                            alt="product" class="h-full w-full object-cover object-center">
                        <div class="absolute top-0 left-0 flex h-full w-full items-center px-8 md:px-12">
                            <div class="max-w-[420px]">
                                <h3>
                                    <a href="#"
                                        class="mb-5 block text-2xl font-bold text-black hover:text-primary sm:text-4xl">
                                        Mega Sale Up To 50% Off For All
                                    </a>
                                </h3>
                                <p class="mb-10 text-base font-medium text-body-color">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                    Vestibulum ornare vestibulum mollis. Nam vitae augue purus.
                                    Integer ac accumsan nunc.
                                </p>
                                <a href="#"
                                    class="inline-flex items-center justify-center rounded bg-primary py-[10px] px-8 text-center text-base font-semibold text-white hover:bg-opacity-90">
                                    Shop Now
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-full px-4 lg:w-4/12">
                    <div class="-mx-4 flex flex-wrap">
                        <div class="w-full px-4 md:w-1/2 lg:w-full">
                            <div class="relative mb-8 h-[223px]">
                                <img src="https://demo.tailgrids.com/templates/planet/build/src/assets/ecom-images/headers/header-04/image-02.jpg"
                                    alt="product" class="h-full w-full object-cover object-center">

                                <div class="absolute z-10 top-0 left-0 flex h-full w-full items-end justify-end p-6 sm:p-9">
                                    <div class="max-w-[180px] text-right">
                                        <h3>
                                            <a href="#"
                                                class="mb-3 block text-lg font-bold text-black hover:text-primary xs:text-xl sm:text-2xl lg:text-xl xl:text-2xl">
                                                Summer Travel Collection
                                            </a>
                                        </h3>
                                        <a href="#"
                                            class="text-base font-semibold text-black hover:text-primary">
                                            Discover Now
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="w-full px-4 md:w-1/2 lg:w-full">
                            <div class="relative mb-8 h-[223px]">
                                <img src="https://demo.tailgrids.com/templates/planet/build/src/assets/ecom-images/headers/header-04/image-03.jpg"
                                    alt="product" class="h-full w-full object-cover object-center">

                                <div class="absolute top-0 left-0 flex h-full w-full items-end justify-end p-6 sm:p-9">
                                    <div class="max-w-[180px] text-right">
                                        <h3>
                                            <a href="#"
                                                class="mb-3 block text-lg font-bold text-black hover:text-primary xs:text-xl sm:text-2xl lg:text-xl xl:text-2xl">
                                                Get 30% Off On iPhone
                                            </a>
                                        </h3>
                                        <a href="#"
                                            class="text-base font-semibold text-black hover:text-primary">
                                            Shop Now
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- !Header -->

    <!-- Products -->
    <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
        <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3 xl:gap-x-8">
            <div class="overflow-hidden rounded-lg bg-white shadow-card bg-gray shadow" v-for="(product, index) in products"
                :key="index">
                <router-link :to="{ name: 'showProduct', params: { product: product.slug } }">
                    <div class="relative h-60 ">
                        <img v-if="product.thumbnail" :src="$storage + product.thumbnail.url" alt="product"
                            class="object-contain absolute h-full w-full">
                    </div>

                    <div class="px-5 pt-6 pb-8 text-center">
                        <h3>
                            <router-link :to="{ name: 'showProduct', params: { product: product.slug } }"
                                class="text-lg font-semibold text-black hover:text-primary xs:text-xl">
                                {{ product.title }}
                            </router-link>
                        </h3>
                        <p class="text-lg font-semibold text-black">{{ formatCurrency.format(product.price) }}</p>
                        <!-- Ratings -->
                        <div class="flex items-center justify-center pt-4 pb-6">
                            <span class="mx-[1px]">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M18.6562 7.46875L12.9999 6.59375L10.4375 1.21875C10.25 0.84375 9.74995 0.84375 9.56245 1.21875L6.99995 6.625L1.37495 7.46875C0.9687 7.53125 0.81245 8.0625 1.12495 8.34375L5.2187 12.5625L4.24995 18.4688C4.18745 18.875 4.5937 19.2188 4.9687 18.9688L10.0624 16.1875L15.1249 18.9688C15.4687 19.1562 15.9062 18.8438 15.8124 18.4688L14.8437 12.5625L18.9374 8.34375C19.1874 8.0625 19.0624 7.53125 18.6562 7.46875Z"
                                        fill="#FFA645"></path>
                                </svg>
                            </span>
                            <span class="mx-[1px]">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M18.6562 7.46875L12.9999 6.59375L10.4375 1.21875C10.25 0.84375 9.74995 0.84375 9.56245 1.21875L6.99995 6.625L1.37495 7.46875C0.9687 7.53125 0.81245 8.0625 1.12495 8.34375L5.2187 12.5625L4.24995 18.4688C4.18745 18.875 4.5937 19.2188 4.9687 18.9688L10.0624 16.1875L15.1249 18.9688C15.4687 19.1562 15.9062 18.8438 15.8124 18.4688L14.8437 12.5625L18.9374 8.34375C19.1874 8.0625 19.0624 7.53125 18.6562 7.46875Z"
                                        fill="#FFA645"></path>
                                </svg>
                            </span>
                            <span class="mx-[1px]">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M18.6562 7.46875L12.9999 6.59375L10.4375 1.21875C10.25 0.84375 9.74995 0.84375 9.56245 1.21875L6.99995 6.625L1.37495 7.46875C0.9687 7.53125 0.81245 8.0625 1.12495 8.34375L5.2187 12.5625L4.24995 18.4688C4.18745 18.875 4.5937 19.2188 4.9687 18.9688L10.0624 16.1875L15.1249 18.9688C15.4687 19.1562 15.9062 18.8438 15.8124 18.4688L14.8437 12.5625L18.9374 8.34375C19.1874 8.0625 19.0624 7.53125 18.6562 7.46875Z"
                                        fill="#FFA645"></path>
                                </svg>
                            </span>
                            <span class="mx-[1px]">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M18.6562 7.46875L12.9999 6.59375L10.4375 1.21875C10.25 0.84375 9.74995 0.84375 9.56245 1.21875L6.99995 6.625L1.37495 7.46875C0.9687 7.53125 0.81245 8.0625 1.12495 8.34375L5.2187 12.5625L4.24995 18.4688C4.18745 18.875 4.5937 19.2188 4.9687 18.9688L10.0624 16.1875L15.1249 18.9688C15.4687 19.1562 15.9062 18.8438 15.8124 18.4688L14.8437 12.5625L18.9374 8.34375C19.1874 8.0625 19.0624 7.53125 18.6562 7.46875Z"
                                        fill="#FFA645"></path>
                                </svg>
                            </span>
                            <span class="mx-[1px]">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M18.6562 7.46875L12.9999 6.59375L10.4375 1.21875C10.25 0.84375 9.74995 0.84375 9.56245 1.21875L6.99995 6.625L1.37495 7.46875C0.9687 7.53125 0.81245 8.0625 1.12495 8.34375L5.2187 12.5625L4.24995 18.4688C4.18745 18.875 4.5937 19.2188 4.9687 18.9688L10.0624 16.1875L15.1249 18.9688C15.4687 19.1562 15.9062 18.8438 15.8124 18.4688L14.8437 12.5625L18.9374 8.34375C19.1874 8.0625 19.0624 7.53125 18.6562 7.46875Z"
                                        fill="#FFA645"></path>
                                </svg>
                            </span>
                        </div>

                        <div class="text-center">
                            <button @click.prevent="cart.addProductToCart(product.slug)"
                                class="inline-flex items-center justify-center rounded-md bg-primary py-3 px-8 text-center text-base font-semibold text-white hover:bg-black">
                                <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-6 w-6" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                Add to Cart
                            </button>
                        </div>
                    </div>
                </router-link>
            </div>
        </div>
    </div>
    <!-- !Products -->
</template>

<script setup>
import useProducts from "@/js/composables/products";
import { onBeforeMount } from "vue";
import { useCartStore } from "../stores/cart";

const { products, getProducts, formatCurrency } = useProducts();
const cart = useCartStore();

onBeforeMount(() => {
    getProducts();

})
</script>
