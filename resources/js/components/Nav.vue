<template>
    <header class="w-full bg-white mb-24">
        <div class="border-b border-[#e7e7e7]">
            <div class="container mx-auto">
                <div class="relative -mx-4 flex items-center justify-center sm:justify-between">
                    <div class="w-60 max-w-full px-4 lg:w-48">
                        <router-link :to="{ name: 'home' }" class="block  py-5 lg:py-3">
                            <img :src="$storage + '/logo.png'" alt="logo" class="w-20 h-16">
                        </router-link>
                    </div>
                    <div class="flex w-full items-center justify-end px-4 lg:justify-between">
                        <div class="flex w-full items-center justify-between px-4">
                        </div>
                        <div class=" w-full items-center justify-end space-x-4 flex pr-5 lg:pr-0">
                            <!-- Profile -->
                            <div ref="dropdownContainer">
                                <div v-if="authStore.user" class="group relative cursor-pointer"
                                    @click="showProfileDropdown">
                                    <div class=" bg-gray-200 flex justify-center items-center dark:bg-gray-500">
                                        <div class="bg-white dark:bg-gray-800 flex justify-center items-center">
                                            <div class="items-center justify-between py-2 text-base font-medium text-dark inline-flex"
                                                :class="profileDropdown.show ? 'border-indigo-700 transform transition duration-300 ' : ''">
                                                <div class="flex justify-center items-center space-x-3 ">
                                                    <div class="font-semibold dark:text-white text-gray-900 text-lg">
                                                        <div>{{ authStore.user.name }}</div>
                                                    </div>
                                                </div>
                                                <span class="pl-2" @click="showProfileDropdown">
                                                    <svg width="11" height="6" viewBox="0 0 11 6" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M5.39683 5.40046C5.20176 5.40046 5.00669 5.33284 4.84413 5.1807L0.487528 0.920728C0.373737 0.802396 0.373737 0.616445 0.471272 0.498112C0.585064 0.37978 0.76388 0.37978 0.877671 0.481208L5.23427 4.74118C5.31555 4.8257 5.46185 4.8257 5.55939 4.74118L9.91599 0.481208C10.0298 0.362875 10.2086 0.37978 10.3224 0.498112C10.4362 0.616445 10.4199 0.802396 10.3061 0.920728L5.94953 5.16379C5.78697 5.31594 5.5919 5.40046 5.39683 5.40046Z"
                                                            fill="currentColor"></path>
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M4.56447 5.4667L0.199071 1.19812C-0.0611467 0.927515 -0.0588086 0.512326 0.16261 0.243696L0.172344 0.231887L0.182952 0.220855C0.450688 -0.0575644 0.874846 -0.0571462 1.14383 0.182609L1.15072 0.188754L5.39683 4.34069L9.63276 0.198704C9.93371 -0.108224 10.3725 -0.0268578 10.6107 0.220855C10.9 0.521698 10.829 0.954046 10.5944 1.19798L10.5854 1.20743L6.22292 5.4559C5.99907 5.66539 5.70971 5.80046 5.39683 5.80046C5.10561 5.80046 4.81129 5.69783 4.5708 5.47274L4.56447 5.4667ZM9.91599 0.481208L5.55939 4.74118C5.46185 4.8257 5.31555 4.8257 5.23427 4.74118L0.877671 0.481208C0.76388 0.37978 0.585064 0.37978 0.471272 0.498112C0.373737 0.616445 0.373737 0.802396 0.487528 0.920728L4.84413 5.1807C5.00669 5.33284 5.20176 5.40046 5.39683 5.40046C5.5919 5.40046 5.78697 5.31594 5.94953 5.16379L10.3061 0.920728C10.4199 0.802396 10.4362 0.616445 10.3224 0.498112C10.2086 0.37978 10.0298 0.362875 9.91599 0.481208Z"
                                                            fill="currentColor"></path>
                                                    </svg>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <ProfileDropdown :profileDropdown="profileDropdown" @click="closeDropdown"/>
                            </div>

                            <template v-if="!authStore.user">
                                <router-link :to="{ name: 'login' }"
                                    class="flex justify-between py-2 text-base font-medium text-dark hover:text-primary lg:mx-5 lg:inline-flex lg:py-6 2xl:mx-6">
                                    Login
                                </router-link>
                                <router-link :to="{ name: 'register' }"
                                    class="flex justify-between py-2 text-base font-medium text-dark hover:text-primary lg:mx-5 lg:inline-flex lg:py-6 2xl:mx-6">
                                    Register
                                </router-link>
                            </template>
                            <!-- Cart -->
                            <div class="relative z-20">
                                <div class="flex max-w-[200px] justify-end">
                                    <router-link :to="{ name: 'cartIndex' }">
                                        <button
                                            class="relative flex h-10 w-10 items-center justify-center rounded-full border-[.5px] border-[#e7e7e7] bg-[#f4f7ff] text-dark">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                            </svg>

                                            <span
                                                class="absolute -top-1 -right-1 h-4 w-4 rounded-full bg-primary text-[10px] font-semibold text-white">
                                                {{ cartStore.cart.length }}
                                            </span>
                                        </button>
                                    </router-link>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div v-if="cartStore.isAddingProduct"
        class="fixed top-10 left-1/4 z-50 w-1/2 h-16  border-t border-gray-200 dark:bg-gray-700 dark:border-gray-600">
        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 object-center"
            role="alert">
            <span class="font-medium">Your product has been added to cart</span>

        </div>

    </div>
</template>

<script setup>
import { onBeforeUnmount, onMounted, ref } from "vue";
import { useAuthStore } from "../stores/auth";
import { useCartStore } from "../stores/cart";
import ProfileDropdown from "./ProfileDropdown.vue";

const authStore = useAuthStore();
const cartStore = useCartStore();

const dropdownContainer = ref();

const profileDropdown = ref({
    show: false,
    profileDropdownItems: {
        profile: true,
        orderHistory: true,
        admin: false,
    }
});

const showProfileDropdown = () => {
    if (authStore.user && authStore.user.id == 1) {
        profileDropdown.value.profileDropdownItems.admin = true;
    } else {
        profileDropdown.value.profileDropdownItems.admin = false;
    }
    profileDropdown.value.show = !profileDropdown.value.show;
}

const closeDropdown = (event) => {
    // Check if the click is outside the dropdown or the user's name
    if (
        !dropdownContainer.value.contains(event.target)
    ) {
        profileDropdown.value.show = false;
    }
};


onMounted(() => {
    window.addEventListener('click', closeDropdown)
})

onBeforeUnmount(() => {
    window.removeEventListener('click', closeDropdown)
})

</script>

<style></style>
