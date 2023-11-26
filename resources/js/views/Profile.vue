<template>
    <div class="md:px-8 px-4 w-1/2 mx-auto mt-24 mb-12">
        <div class="bg-white rounded-lg shadow md:px-8 px-4  mx-auto mt-12 mb-12">
            <div class="flex">
                <div class="flex-1 py-5 overflow-hidden">
                    <h1 class="inline text-2xl font-semibold leading-none">Profile Information</h1>
                </div>
            </div>
            <form @submit.prevent="updateProfile">
                <div class="space-y-4">
                    <div class="my-4">
                        <label for="name">Name</label>
                        <input v-model="auth.user.name"
                            class=" text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">
                        <div v-if="errors.name">
                            <span class="text-sm text-red-400">
                                {{ errors.name[0] }}
                            </span>
                        </div>
                    </div>
                    <div class="my-4">
                        <label for="email">E-mail Address</label>
                        <input v-model="auth.user.email"
                            class=" text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">
                        <div v-if="errors.email">
                            <span class="text-sm text-red-400">
                                {{ errors.email[0] }}
                            </span>
                        </div>
                    </div>

                </div>
                <hr class="mt-4">
                <div class="flex flex-row-reverse p-3">
                    <div class="flex-initial pl-3">
                        <button type="submit"
                            class="flex items-center px-5 py-2.5 font-medium tracking-wide text-white capitalize   bg-primary rounded-md hover:bg-gray-800  focus:outline-none focus:bg-gray-900  transition duration-300 transform active:scale-95 ease-in-out">
                            <span>Update</span>
                        </button>
                    </div>
                </div>
            </form>
            <hr class="mt-4">
            <div class="flex">
                <div class="flex-1 py-5 overflow-hidden">
                    <h1 class="inline text-2xl font-semibold leading-none">Change Your Password</h1>
                </div>
            </div>
            <form @submit.prevent="updatePassword">
                <div class="space-y-4">
                    <div class="my-4">
                        <label for="name">Current Password</label>
                        <input v-model="password.current_password" type="password"
                            class=" text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">
                        <div v-if="errors.current_password">
                            <span class="text-sm text-red-400">
                                {{ errors.current_password[0] }}
                            </span>
                        </div>
                    </div>
                    <div class="my-4">
                        <label for="password">New Password</label>
                        <input v-model="password.password" type="password"
                            class=" text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">
                        <div v-if="errors.password">
                            <span class="text-sm text-red-400">
                                {{ errors.password[0] }}
                            </span>
                        </div>
                    </div>
                    <div class="my-4">
                        <label for="password_confirmation">Confirm New Password</label>
                        <input v-model="password.password_confirmation" type="password"
                            class=" text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">

                    </div>

                </div>
                <hr class="mt-4">
                <div class="flex flex-row-reverse p-3">
                    <div class="flex-initial pl-3">
                        <button type="submit"
                            class="flex items-center px-5 py-2.5 font-medium tracking-wide text-white capitalize   bg-primary rounded-md hover:bg-gray-800  focus:outline-none focus:bg-gray-900  transition duration-300 transform active:scale-95 ease-in-out">
                            <span>Change</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script setup>
import { ref } from "vue";
import { useAuthStore } from "../stores/auth";

const auth = useAuthStore();

const profile = ref({
    name: auth.user.name,
    email: auth.user.email,
});

const password = ref({
    current_password: null,
    password: null,
    password_confirmation: null
});

const errors = ref({});

const updateProfile = async () => {
    try {
        const res = await axios.post('/api/admin/products', data);
        console.log(res.data);
    } catch (err) {
        if (err.response.status === 422) {
            err.value = err.response.data.errors;
        }
    }
}

const updatePassword = async () => {
    try {
        const res = await axios.post('/api/admin/products', data);
        console.log(res.data);
    } catch (err) {
        if (err.response.status === 422) {
            err.value = err.response.data.errors;
        }
    }
}

</script>

<style></style>