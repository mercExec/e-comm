<template>
    <div class="md:px-8 px-4 max-w-2xl mx-auto mt-24 mb-12">
        <div class="bg-white rounded-lg shadow md:px-8 px-4 max-w-2xl mx-auto mt-12 mb-12">
            <div class="flex">
                <div class="flex-1 py-5 overflow-hidden">
                    <h1 class="inline text-2xl font-semibold leading-none">Edit Product: {{ product.title }}</h1>
                </div>
            </div>
            <form @submit.prevent="updateProduct($route.params.product)" enctype="multipart/form-data">
                <div class="space-y-4">
                    <div class="my-4">
                        <input placeholder="Title" v-model="product.title"
                            class=" text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base   transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">
                        <div v-if="errors.title">
                            <span class="text-sm text-red-400">
                                {{ errors.title[0] }}
                            </span>
                        </div>
                    </div>

                    <div class="my-4">
                        <textarea placeholder="Description" v-model="product.description"
                            class=" text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base   transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400"></textarea>
                        <div v-if="errors.description">
                            <span class="text-sm text-red-400">
                                {{ errors.description[0] }}
                            </span>
                        </div>
                    </div>

                    <div class="my-4">
                        <input placeholder="Price" v-model="product.price"
                            class=" text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base   transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">
                        <div v-if="errors.price">
                            <span class="text-sm text-red-400">
                                {{ errors.price[0] }}
                            </span>
                        </div>
                    </div>

                    <div class="my-4">
                        <label for="status" class="block">
                            Product Status
                        </label>
                        <select name="status" v-model="product.status"
                            class="w-44 text-sm text-gray-600 py-3 px-4 border-gray-300 shadow-sm rounded focus:ring-primary focus:border-primary">
                            <option value="" disabled selected>Select Status</option>
                            <option value="1">Hidden</option>
                            <option value="2">Visible</option>
                        </select>
                        <div v-if="errors.status">
                            <span class="text-sm text-red-400">
                                {{ errors.status[0] }}
                            </span>
                        </div>
                    </div>

                    <div class="my-4">
                        <label for="images" class="text-gray-600">Images <span class="text-primary">*</span></label><br>
                        <label for="images" class="text-gray-500 text-xs py-2">Maximum 5 images. You can delete any old
                            image by clicking on it</label>
                        <div
                            class="overflow-auto w-full grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-2 gap-4 product-image">
                            <ul v-for="(image, index) in product.images" :key="image.id">
                                <li>
                                    <input type="checkbox" :id="'cb' + index" :name="index" @change="deleteImage"
                                        :value="image.url">
                                    <label :for="'cb' + index">
                                        <img :src="$storage + image.url"
                                            alt="Product Image" class="h-48 mb-3 w-full p-3 rounded-lg object-cover">
                                    </label>
                                </li>
                            </ul>
                        </div>

                        <div class="mx-auto h-72 flex flex-col items-center">
                            <div class="flex w-full justify-center">
                                <div id="multi-upload-button"
                                    class="inline-flex items-center px-4 py-2 bg-gray-600 border border-gray-600 rounded-l font-semibold cursor-pointer text-sm text-white tracking-widest hover:bg-gray-500 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition ">
                                    Upload more images
                                </div>
                                <div class="w-full border border-gray-300 rounded-r-md flex items-center justify-between">
                                    <span id="multi-upload-text" class="p-2"></span>
                                    <a id="multi-upload-delete" class="hidden" @click="removeMultiUpload">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="fill-current text-red-700 w-3 h-3"
                                            viewBox="0 0 320 512">
                                            <path
                                                d="M310.6 361.4c12.5 12.5 12.5 32.75 0 45.25C304.4 412.9 296.2 416 288 416s-16.38-3.125-22.62-9.375L160 301.3L54.63 406.6C48.38 412.9 40.19 416 32 416S15.63 412.9 9.375 406.6c-12.5-12.5-12.5-32.75 0-45.25l105.4-105.4L9.375 150.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L160 210.8l105.4-105.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-105.4 105.4L310.6 361.4z" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                            <input type="file" id="multi-upload-input" class="hidden" name="newImages[]" multiple @change="uploadeImages" />
                            <div id="images-container"></div>
                        </div>
                    </div>
                    <div v-if="errors.newImages">
                        <span class="text-sm text-red-400">
                            {{ errors.newImages[0] }}
                        </span>
                    </div>
                </div>
                <hr class="mt-4">
                <div class="flex flex-row-reverse p-3">
                    <div class="flex-initial pl-3">
                        <button type="submit"
                            class="flex items-center px-5 py-2.5 font-medium tracking-wide text-white capitalize   bg-black rounded-md hover:bg-gray-800  focus:outline-none focus:bg-gray-900  transition duration-300 transform active:scale-95 ease-in-out">
                            <span>Update</span>
                        </button>
                    </div>
                    <div class="flex-initial">
                        <button type="button" @click="router.go(-1)"
                            class="flex items-center px-5 py-2.5 font-medium tracking-wide text-black capitalize rounded-md  hover:bg-red-200 hover:fill-current hover:text-red-600  focus:outline-none  transition duration-300 transform active:scale-95 ease-in-out">
                            <span>Cancel</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>
<script setup>
import useProducts from "@/js/composables/products";
import { onMounted, ref } from "vue";
import { useRouter } from "vue-router";

const router = useRouter();

let imageUpload = ref({
    multiUploadButton: null,
    multiUploadInput: null,
    imagesContainer: null,
    multiUploadDisplayText: null,
    multiUploadDeleteButton: null,
});

const props = defineProps({
    product: {
        required: true,
        type: String
    }
});

const { product, getProduct, updateProduct, errors } = useProducts();

const removeMultiUpload = () => {
    imageUpload.value.imagesContainer.innerHTML = '';
    imageUpload.value.imagesContainer.classList.remove("overflow-auto", "w-full", "grid", "grid-cols-1", "sm:grid-cols-2",
        "md:grid-cols-3",
        "lg:grid-cols-2", "gap-4");
    imageUpload.value.multiUploadInput.value = '';
    imageUpload.value.multiUploadDisplayText.innerHTML = '';
    imageUpload.value.multiUploadDeleteButton.classList.add("hidden");
    imageUpload.value.multiUploadDeleteButton.classList.remove("z-100", "p-2", "my-auto");
}

const deleteImage = (event) => {
    if (!product.value.deletedImages) {
        product.value.deletedImages = [];
    }

    if (event.target.checked) {
        product.value.deletedImages[event.target.name] = event.target.value;
    } else if (!event.target.checked) {
        product.value.deletedImages.splice(event.target.name, 1);
    }
}

const uploadeImages = (e) => {
    if (e.target.files) {
        product.value.newImages = e.target.files;
        // console.log(product.value, product.value.newImages, product.value.deletedImages);

        let files = imageUpload.value.multiUploadInput.files;

        // show the text for the upload button text field
        imageUpload.value.multiUploadDisplayText.innerHTML = files.length + ' files selected';

        // removes styles from the images wrapper container in case the user read new images
        imageUpload.value.imagesContainer.innerHTML = '';
        imageUpload.value.imagesContainer.classList.remove("overflow-auto", "w-full", "grid", "grid-cols-1", "sm:grid-cols-2",
            "md:grid-cols-2", "lg:grid-cols-2", "gap-4");

        // add styles to the images wrapper container
        imageUpload.value.imagesContainer.classList.add("overflow-auto", "w-full", "grid", "grid-cols-1", "sm:grid-cols-2",
            "md:grid-cols-3",
            "lg:grid-cols-2", "gap-4");

        // the delete button to delete all files
        imageUpload.value.multiUploadDeleteButton.classList.add("z-100", "p-2", "my-auto");
        imageUpload.value.multiUploadDeleteButton.classList.remove("hidden");

        Object.keys(files).forEach(function (key) {

            let file = files[key];

            // the FileReader object is needed to display the image
            let reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onload = function (e) {

                // for each file we create a div to contain the image
                let image = document.createElement('img');
                image.classList.add("h-48", "mb-3", "w-full", "p-3", "rounded-lg",
                    "object-cover");
                image.src = e.target.result;

                imageUpload.value.imagesContainer.appendChild(image);
            }
        })
    }
}

onMounted(() => {
    imageUpload = ref({
        multiUploadButton: document.getElementById("multi-upload-button"),
        multiUploadInput: document.getElementById("multi-upload-input"),
        imagesContainer: document.getElementById("images-container"),
        multiUploadDisplayText: document.getElementById("multi-upload-text"),
        multiUploadDeleteButton: document.getElementById("multi-upload-delete"),
    })
    imageUpload.value.multiUploadButton.onclick = function () {
        imageUpload.value.multiUploadInput.click(); // this will trigger the click event
    };

    getProduct(props.product);

})
</script>

<style>
div.product-image ul {
    list-style-type: none;
}

div.product-image li {
    display: inline-block;
}

div.product-image input[type="checkbox"][id^="cb"] {
    display: none;
}

div.product-image label {
    border: 1px solid #fff;
    padding: 10px;
    display: block;
    position: relative;
    margin: 10px;
    cursor: pointer;
}

div.product-image label:before {
    background-color: white;
    color: white;
    content: " ";
    display: block;
    border-radius: 50%;
    border: 1px solid grey;
    position: absolute;
    top: -5px;
    left: -5px;
    width: 25px;
    height: 25px;
    text-align: center;
    line-height: 28px;
    transition-duration: 0.4s;
    transform: scale(0);
}

div.product-image label img {
    transition-duration: 0.2s;
    transform-origin: 50% 50%;
}

div.product-image :checked+label {
    border-color: #ddd;
}

div.product-image :checked+label:before {
    content: "X";
    background-color: grey;
    transform: scale(1);
}

div.product-image :checked+label img {
    transform: scale(0.9);
    box-shadow: 0 0 5px #333;
    z-index: -1;
}
</style>