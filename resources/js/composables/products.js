import axios from "axios";
import { ref } from "vue";
import { useRouter } from "vue-router";

export default function useProducts() {
    const products = ref([]);
    const product = ref({});

    const errors = ref({});

    const router = useRouter();

    const getProducts = async () => {
        const response = await axios.get('/api/products');
        products.value = response.data.data;
    }

    const getProduct = (slug) => {
        axios.get('/api/products/' + slug).then((res) => {
            product.value = res.data;
        });
    }

    const storeProduct = async (data) => {
        try {
            await axios.post('/api/admin/products', data, { headers: { 'Content-Type': 'multipart/form-data' } });
            router.push({ name: 'admin.productsIndex' });
        } catch (err) {
            if (err.response.status === 422) {
                err.value = err.response.data.errors;
            }
        }
    }

    const updateProduct = async (slug) => {
        try {
            product.value._method = 'put';
            // console.log(product.value);
            await axios.post('/api/admin/products/' + slug, product.value, { headers: { 'Content-Type': 'multipart/form-data' } });
            router.push({
                name: "admin.productsIndex"
            });
        } catch (error) {
            if (error.response.status === 422) {
                errors.value = error.response.data.errors;
                console.log(errors.value);
            }
        }
    }

    const destroyProduct = async (slug) => {
        if (!window.confirm("Are you sure?")) {
            return;
        }

        await axios.delete('/api/admin/products/' + slug);
        await getProducts();
    }

    const formatCurrency = new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: 'USD',
    });

    return {
        product,
        products,
        getProduct,
        getProducts,
        storeProduct,
        updateProduct,
        destroyProduct,
        errors,
        formatCurrency
    };
}
