<template>
    <section>
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto lg:py-0">
            <div class="m-2 p-2 text-green-900 font-semibold bg-green-300 rounded-md" v-if="auth.status">
            {{ auth.status }}
            </div>
            <div
                class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        Sign in to your account
                    </h1>
                    <form class="space-y-4 md:space-y-6" action="#" @submit.prevent="handleLogin(form)">
                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
                                email</label>
                            <input type="email" name="email" id="email" v-model="form.email"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="name@company.com" >
                                <div v-if="auth.authErrors.email">
                                    <span class="text-red-400 text-sm m-2 p-2">
                                        {{ auth.authErrors.email[0] }}
                                    </span>
                                </div>
                        </div>
                        <div>
                            <label for="password"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                            <input type="password" name="password" id="password" v-model="form.password"
                                placeholder="••••••••"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            >
                            <div v-if="auth.authErrors.password">
                                    <span class="text-red-400 text-sm m-2 p-2">
                                        {{ auth.authErrors.password[0] }}
                                    </span>
                                </div>

                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-start">
                                <div class="flex items-center h-5">
                                    <input id="remember" aria-describedby="remember" type="checkbox"
                                        class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800"
                                        >
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="remember" class="text-gray-500 dark:text-gray-300">Remember me</label>
                                </div>
                            </div>
                            <router-link :to="{name: 'forgotPassword'}" class="text-sm font-medium text-blue-600 hover:underline dark:text-blue-500">Forgot
                                password?</router-link>
                        </div>
                        <button type="submit"
                            class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Sign
                            in</button>
                        <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                            Don't have an account yet? <router-link :to="{name: 'register'}"
                                class="font-medium text-blue-600 hover:underline dark:text-blue-500">Sign up</router-link>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import { onUnmounted, ref } from "vue";
import { useAuthStore } from "@/js/stores/auth";
import { useCartStore } from "@/js/stores/cart";

const auth = useAuthStore();
const cart = useCartStore();

const handleLogin = async (form) => {
    try {
        await auth.handleLogin(form)
            .then(async () => {
                console.log(cart.getNumberOfProducts() > 0, auth.user);
                if (cart.getNumberOfProducts() > 0) {
                    console.log('add to db from cookie');
                    await cart.addCookieProductsToDB();
                }

                cart.getAllProducts();
            });
    } catch (error) {
        console.log(error);
    }
}

const form = ref({
    email: '',
    password: ''
});

onUnmounted(() => {
    auth.authErrors = [];
    auth.authStatus = null;
})

</script>

<style></style>
