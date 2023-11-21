<template>
    <!-- component -->
    <div class="container mx-auto pt-24">
        <div class="-mx-4 flex flex-wrap">
            <div class="w-full px-4 lg:w-1/2 xl:w-7/12">

                <Carousel v-if="product.images">
                    <Slide v-for="image in product.images" :key="image">
                        <div class="md:h-[570px] h-[300px] md:w-[1040px] w-[800px]">
                            <img :src="$storage + image.url" class="object-contain md:h-[570px] h-[300px] md:w-[1040px] w-[800px]">
                        </div>
                    </Slide>

                    <template #addons>
                        <Navigation />
                        <Pagination />
                    </template>
                </Carousel>

            </div>

            <div class="w-full px-4 pt-20 lg:w-1/2 xl:w-5/12">
                <div>
                    <h2 class="mb-5 text-2xl font-bold text-black sm:text-3xl md:text-4xl lg:text-3xl xl:text-4xl">
                        {{ product.title }}
                    </h2>

                    <div class="mb-8 flex flex-wrap items-center">

                        <div class="flex items-center">
                            <span class="pr-2">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M10 19.625C4.6875 19.625 0.40625 15.3125 0.40625 10C0.40625 4.6875 4.6875 0.40625 10 0.40625C15.3125 0.40625 19.625 4.6875 19.625 10C19.625 15.3125 15.3125 19.625 10 19.625ZM10 1.5C5.3125 1.5 1.5 5.3125 1.5 10C1.5 14.6875 5.3125 18.5313 10 18.5313C14.6875 18.5313 18.5313 14.6875 18.5313 10C18.5313 5.3125 14.6875 1.5 10 1.5Z"
                                        fill="#13C296"></path>
                                    <path
                                        d="M8.9375 12.1875C8.71875 12.1875 8.53125 12.125 8.34375 11.9687L6.28125 9.96875C6.0625 9.75 6.0625 9.40625 6.28125 9.1875C6.5 8.96875 6.84375 8.96875 7.0625 9.1875L8.9375 11.0312L12.9375 7.15625C13.1562 6.9375 13.5 6.9375 13.7188 7.15625C13.9375 7.375 13.9375 7.71875 13.7188 7.9375L9.5625 12C9.34375 12.125 9.125 12.1875 8.9375 12.1875Z"
                                        fill="#13C296"></path>
                                </svg>
                            </span>
                            <span class="text-base font-medium text-black">
                                In Stock
                            </span>
                        </div>
                    </div>

                    <p class="mb-10 text-base font-medium text-body-color">
                        {{ product.description }}
                    </p>

                    <div class="mb-9 flex-wrap justify-between xs:flex">
                        <div class="xs:text-right">
                            <span class="mb-3 block text-3xl font-bold text-black">
                                {{ formatCurrency.format(product.price) }}
                            </span>
                            <span class="text-base font-medium text-body-color">
                                +12% VAT Added
                            </span>
                        </div>
                    </div>

                    <div class="mb-8">
                        <button @click.prevent="handleAddToCart(product.slug)"
                            class="flex w-full items-center justify-center rounded-md bg-primary py-3 px-10 text-center text-base font-semibold text-white hover:bg-opacity-90">
                            Add to Cart
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import axios from "axios";
import { onMounted, ref } from "vue";
import useProducts from "../composables/products";
import { useCartStore } from "../stores/cart";
import { Carousel, Navigation, Pagination, Slide } from 'vue3-carousel'
import 'vue3-carousel/dist/carousel.css'

const props = defineProps({
    product: {
        required: true,
        type: String
    }
});

const { product, getProduct, formatCurrency } = useProducts();
const cart = useCartStore();

const handleAddToCart = async (productSlug) => {
    cart.addProductToCart(productSlug);
}

onMounted(() => {
    getProduct(props.product);
});
</script>

<style>.carousel__item {
    min-height: 200px;
    width: 100%;
    background-color: var(--vc-clr-primary);
    color: var(--vc-clr-white);
    font-size: 20px;
    border-radius: 8px;
    display: flex;
    justify-content: center;
    align-items: center;
}

.carousel__slide {
    padding: 10px;
}

.carousel__prev,
.carousel__next {
    box-sizing: content-box;
    border: 2px solid #3056d3;
    color: #3056d3;
}</style>