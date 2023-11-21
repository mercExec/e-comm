<template>
    <div v-if="profileDropdown.show"
        class="dropdown-menu right-0 z-30 rounded-lg bg-white transition-all opacity-100 absolute top-full w-64 border-[.5px] border-[#e7e7e7] py-8 px-12 cursor-default">
        <ul class="space-y-3 dark:text-white">
            <li class="font-medium" v-if="profileDropdown.profileDropdownItems.profile"
                @click="profileDropdown.show = false">
                <router-link :to="{ name: 'profileIndex' }"
                    class="flex items-center transform transition-colors duration-200 border-r-4 border-transparent hover:border-indigo-700">
                    <div class="mr-3">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                            </path>
                        </svg>
                    </div>
                    Profile
                </router-link>
            </li>
            <li class="font-medium" v-if="profileDropdown.profileDropdownItems.admin" @click="profileDropdown.show = false">
                <router-link :to="{ name: 'adminIndex' }"
                    class="flex items-center transform transition-colors duration-200 border-r-4 border-transparent hover:border-indigo-700">
                    <div class="mr-3">
                        <svg fill="#000000" class="w-6 h-6" viewBox="0 0 1920 1920"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M1556.611 1920c-54.084 0-108.168-20.692-149.333-61.857L740.095 1190.96c-198.162 41.712-406.725-19.269-550.475-163.019C14.449 852.771-35.256 582.788 65.796 356.27l32.406-72.696 390.194 390.193c24.414 24.305 64.266 24.305 88.68 0l110.687-110.686c11.824-11.934 18.283-27.59 18.283-44.34 0-16.751-6.46-32.516-18.283-44.34L297.569 84.207 370.265 51.8C596.893-49.252 866.875.453 1041.937 175.515c155.026 155.136 212.833 385.157 151.851 594.815l650.651 650.651c39.961 39.852 61.967 92.95 61.967 149.443 0 56.383-22.006 109.482-61.967 149.334l-138.275 138.385c-41.275 41.165-95.36 61.857-149.553 61.857Z"
                                fill-rule="evenodd" />
                        </svg>
                    </div>
                    Admin Panel
                </router-link>
            </li>
            <li class="font-medium" v-if="profileDropdown.profileDropdownItems.orderHistory"
                @click="profileDropdown.show = false">
                <router-link :to="{ name: 'ordersIndex' }"
                    class="flex items-center transform transition-colors duration-200 border-r-4 border-transparent hover:border-indigo-700">
                    <div class="mr-3">
                        <svg class="w-6 h-6" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" fill="#000000"
                            style="--darkreader-inline-fill: #000000; --darkreader-inline-stroke: #000000;"
                            data-darkreader-inline-fill="" stroke="#000000" stroke-width="0.00016"
                            data-darkreader-inline-stroke="">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <g fill="#000000" fill-rule="evenodd" transform="translate(2 1)"
                                    style="--darkreader-inline-fill: #000000;" data-darkreader-inline-fill="">
                                    <path fill-rule="nonzero"
                                        d="M3 4C3 3.44772 3.44772 3 4 3 4.55228 3 5 3.44772 5 4 5 4.55228 4.55228 5 4 5 3.44772 5 3 4.55228 3 4zM7 3C6.44772 3 6 3.44772 6 4 6 4.55228 6.44771 5 7 5L8 5C8.5523 5 9 4.55228 9 4 9 3.44772 8.5523 3 8 3L7 3zM6 7C6 6.44772 6.44772 6 7 6L8 6C8.5523 6 9 6.44772 9 7 9 7.55228 8.5523 8 8 8L7 8C6.44771 8 6 7.55228 6 7zM3 7C3 6.44772 3.44772 6 4 6 4.55228 6 5 6.44772 5 7 5 7.55228 4.55228 8 4 8 3.44772 8 3 7.55228 3 7zM6 10C6 9.4477 6.44772 9 7 9L8 9C8.5523 9 9 9.4477 9 10 9 10.5523 8.5523 11 8 11L7 11C6.44771 11 6 10.5523 6 10zM3 10C3 9.4477 3.44772 9 4 9 4.55228 9 5 9.4477 5 10 5 10.5523 4.55228 11 4 11 3.44772 11 3 10.5523 3 10z">
                                    </path>
                                    <path
                                        d="M0,1 C0,0.44772 0.44772,0 1,0 L11,0 C11.5523,0 12,0.44772 12,1 L12,13 C12,13.5523 11.5523,14 11,14 L1,14 C0.44772,14 0,13.5523 0,13 L0,1 Z M2,12 L2,2 L10,2 L10,12 L2,12 Z">
                                    </path>
                                </g>
                            </g>
                        </svg>
                    </div>
                    Orders History
                </router-link>
            </li>
            <hr class="dark:border-gray-700">
            <li class="font-medium z-20 cursor-pointer" @click.prevent="handleLogout">
                <div
                    class="flex items-center transform transition-colors duration-200 border-r-4 border-transparent hover:border-red-600">
                    <div class="mr-3 text-red-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                            </path>
                        </svg>
                    </div>
                    Logout
                </div>
            </li>
        </ul>
    </div>
</template>

<script setup>
import { ref, watch } from "vue";
import { useAuthStore } from "../stores/auth";
import { useCartStore } from "../stores/cart";

const props = defineProps({
    profileDropdown: Object
})

const authStore = useAuthStore();
const cartStore = useCartStore();

const handleLogout = async () => {
    profileDropdown.value.show = false;
    try {
        await authStore.handleLogout();

        await cartStore.resetCart();
    } catch (error) {
        console.log(error);
    }
}

const profileDropdown = ref(props.profileDropdown);

watch(
    () => props.profileDropdown,
    () => { profileDropdown.value = props.profileDropdown; }, { deep: true }
);

</script>

<style></style>