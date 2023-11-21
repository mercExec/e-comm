<template>
    <div v-if="isUserDeleted"
        class="fixed top-10 left-1/4 z-50 w-1/2 h-16  border-t border-gray-200 dark:bg-gray-700 dark:border-gray-600">
        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 object-center"
            role="alert">
            <span class="font-medium">User has been deleted successfully</span>
        </div>
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
                                    Name
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                    Created At
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                            <tr class="hover:bg-gray-100 dark:hover:bg-gray-700" v-for="(user, index) in users.data"
                                :key="index">
                                <td class="flex items-center p-4 mr-12 space-x-6 whitespace-nowrap">
                                    <div class="text-sm font-normal text-gray-500 dark:text-gray-400">
                                        <div class="text-base font-semibold text-gray-900 dark:text-white">{{ user.name }}
                                        </div>
                                        <div class="text-sm font-normal text-gray-500 dark:text-gray-400">{{ user.email }}
                                        </div>
                                    </div>
                                </td>
                                <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ user.created_at }}
                                </td>
                                <td class="p-4 space-x-2 whitespace-nowrap">
                                    <button type="button" data-modal-toggle="delete-user-modal" @click="showModal(user, index)" v-if="user.id !== auth.user.id"
                                        class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-800 focus:ring-4 focus:ring-red-300 dark:focus:ring-red-900">
                                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        Delete user
                                    </button>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div
        class="sticky bottom-0 right-0 items-center w-full p-4 bg-white border-t border-gray-200 sm:flex sm:justify-between dark:bg-gray-800 dark:border-gray-700">
        <TailwindPagination :data="users" @pagination-change-page="list"></TailwindPagination>
    </div>

    <!-- Delete User Modal -->
    <div class="fixed left-0 right-0 z-50 items-center justify-center overflow-x-hidden overflow-y-auto top-4 md:inset-0 h-modal sm:h-full flex" v-if="user" @show="isModalOpen">
        <div class="relative w-full h-full max-w-md px-4 md:h-auto">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-800">
                <!-- Modal header -->
                <div class="flex justify-end p-2">
                    <button type="button" @click="closeModal"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-700 dark:hover:text-white">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-6 pt-0 text-center">
                    <svg class="w-16 h-16 mx-auto text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <h3 class="mt-5 mb-6 text-lg text-gray-500 dark:text-gray-400">Are you sure you want to delete this
                        user?</h3>
                    <a @click.prevent="deleteUser()"
                        class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-base inline-flex items-center px-3 py-2.5 text-center mr-2 dark:focus:ring-red-800 cursor-pointer">
                        Yes, I'm sure
                    </a>
                    <a v-if="user" @click.prevent="closeModal"
                        class="text-gray-900 bg-white hover:bg-gray-100 focus:ring-4 focus:ring-primary-300 border border-gray-200 font-medium inline-flex items-center rounded-lg text-base px-3 py-2.5 text-center dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-gray-700 cursor-pointer">
                        No, cancel
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import axios from "axios";
import { onMounted, ref } from "vue";
import { TailwindPagination } from 'laravel-vue-pagination';
import { useAuthStore } from "@/js/stores/auth";

const auth = useAuthStore();
const users = ref({});
const user = ref(null);
const isModalOpen = ref(false);
const isUserDeleted = ref(false);

const list = async (page = 1) => {
    await axios.get(`/api/admin/users?page=${page}`).then(({ data }) => {
        users.value = data;
        console.log(users.value);
    }).catch(({ response }) => {
        console.error(response)
    })
}

const showModal = (userObj, index) => {
    isModalOpen.value = true;
    user.value = userObj;
    user.value.index = index;
    console.log(users.value.data);
}

const closeModal = () => {
    isModalOpen.value = false;
    user.value = null;
}

const deleteUser = async () => {
    if (user) {
        const res = await axios.post('/api/admin/users/delete/' + user.value.id);
        console.log(res);
        if (res.status == 200) {
            users.value.data.splice(user.value.index, 1)

            isModalOpen.value = false;
            user.value = null;

        }
    } else {
        console.log('User is not set');
    }
}

onMounted(async () => {
    list();
})

</script>

<style></style>