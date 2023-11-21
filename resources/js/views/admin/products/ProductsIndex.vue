<template>
    <div v-if="isProductDeleted"
        class="fixed top-10 left-1/4 z-50 w-1/2 h-16  border-t border-gray-200 dark:bg-gray-700 dark:border-gray-600">
        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 object-center"
            role="alert">
            <span class="font-medium">Product has been deleted successfully</span>
        </div>
    </div>

    <div class=" container mx-auto">
        <div class="flex justify-end m-2 p-2">
            <RouterLink :to="{ name: 'admin.createProduct' }"
                class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 text-white rounded">Create Product</RouterLink>
        </div>
        <div class="flex flex-col">
            <div class="overflow-x-auto">
                <div class="inline-block min-w-full align-middle">
                    <div class="overflow-hidden shadow">
                        <table class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-600">
                            <thead class="bg-gray-100 dark:bg-gray-700">
                                <tr>
                                    <th scope="col"
                                        class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                        Title
                                    </th>
                                    <th scope="col"
                                        class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                        Slug
                                    </th>
                                    <th scope="col"
                                        class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                                <tr class="hover:bg-gray-100 dark:hover:bg-gray-700" v-for="(product) in products"
                                    :key="product.id">

                                    <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ product.title }}
                                    </td>
                                    <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ product.slug }}
                                    </td>
                                    <td class="p-4 space-x-2 whitespace-nowrap">
                                        <RouterLink :to="{ name: 'admin.editProduct', params: { product: product.slug } }">
                                            <button type="button"
                                                class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-adminPrimary-700 hover:bg-adminPrimary-800 focus:ring-4 focus:ring-adminPrimary-300 dark:bg-adminPrimary-600 dark:hover:bg-adminPrimary-700 dark:focus:ring-adminPrimary-800">
                                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z">
                                                    </path>
                                                    <path fill-rule="evenodd"
                                                        d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                                Edit
                                            </button>
                                        </RouterLink>
                                        <button type="button" @click="handleDeleteProduct(product.slug)"
                                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-800 focus:ring-4 focus:ring-red-300 dark:focus:ring-red-900">
                                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                    d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                            Delete
                                        </button>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script setup>
import useProducts from "@/js/composables/products";
import { onMounted, ref } from "vue";

const { products, getProducts, destroyProduct } = useProducts();

const isProductDeleted = ref(false);

const handleDeleteProduct = (productSlug) => {
    destroyProduct(productSlug);

    isProductDeleted.value = true;
    setTimeout(() => {
        isProductDeleted.value = false;
    }, 3000);
}

onMounted(() => {
    getProducts();
})
</script>

<style></style>