import { defineStore } from "pinia";
import axios from "axios";

export const useCartStore = defineStore("cart", {
    state: () => ({
        cartProducts: [],
        quantityTimeouts: [], // To store the timeout IDs,
        isUpdatingQuantity: false,
        isAddingProduct: false
    }),
    getters: {
        cart: (state) => state.cartProducts,
    },
    actions: {
        async addProductToCart(productSlug) {
            this.isAddingProduct = true;
            setTimeout(() => {
                this.isAddingProduct = false;
            }, 3000);
            const { data } = await axios.post('/api/cart/' + productSlug);

            this.cartProducts = this.getAllProducts();
        },
        async getAllProducts() {
            const { data } = await axios.get('/api/cart');
            this.cartProducts = data;
        },
        async addCookieProductsToDB() {
            const { data } = await axios.post('/api/addCookieProductsToDB');
            this.cartProducts = data;
        },
        async deleteProductFromCookie(productIndex) {
            this.cartProducts.splice(productIndex, 1);

            let cartData = new FormData();
            cartData.append('cart', JSON.stringify(this.cartProducts));

            await axios.post('/api/cart/deleteProductFromCookie', cartData);
        },
        async deleteProductFromDB(cartProductId, productIndex) {
            this.cartProducts.splice(productIndex, 1);
            await axios.get('/api/cart/deleteProductFromDB/' + cartProductId);
        },
        resetCart() {
            this.cartProducts = [];
        },
        async handleQuantityChange(cartProductId, cartindex, storageSource) {
            // Clear any existing timeout for this item
            if (this.quantityTimeouts[cartindex]) {
                clearTimeout(this.quantityTimeouts[cartindex]);
            }

            // Set a new timeout for 3 seconds
            this.quantityTimeouts[cartindex] = setTimeout(async () => {
                let quantity = document.getElementById('product_quantity_' + cartindex).value;
                storageSource == 'db' ? await this.updateQuantityInDB(cartProductId, cartindex, quantity) : await this.updateQuantityInCookie();
                this.quantityTimeouts[cartindex] = null; // Clear the timeout ID
            }, 500);
        },
        async updateQuantityInDB(cartProductId, cartindex, quantity) {
            this.isUpdatingQuantity = true;

            let form = new FormData();
            form.append('quantity', quantity);

            await axios.post('/api/cart/updateQuantityInDB/' + cartProductId, form);
            this.isUpdatingQuantity = false;
        },
        async updateQuantityInCookie() {
            this.isUpdatingQuantity = true;

            let cartData = new FormData();
            cartData.append('cart', JSON.stringify(this.cartProducts))

            await axios.post('/api/cart/updateQuantityInCookie', cartData);
            this.isUpdatingQuantity = false;
        },
        deleteAllProducts() {

        },
        getNumberOfProducts() {
            return this.cartProducts.length;
        },
        cartTotalPrice() {
            return this.cartProducts.reduce((acc, cartProduct) => acc + (cartProduct.product.price * cartProduct.quantity), 0);
        },
        resetUpdate() {
            this.isUpdatingQuantity = false;
        }
    },
    persist: true,
});