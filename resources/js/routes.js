import { createRouter, createWebHistory } from 'vue-router';

import Shop from './layouts/Shop.vue'

import Home from './views/Home.vue';
import Product from './views/Product.vue';
import Profile from './views/Profile.vue';
import Test from './views/Test.vue';

import Login from './views/auth/Login.vue';
import Register from './views/auth/Register.vue';
import ForgotPassword from './views/auth/ForgotPassword.vue';
import ResetPassword from './views/auth/ResetPassword.vue';

import Admin from './layouts/Admin.vue';
import Dashboard from './views/admin/Dashboard.vue'

import AdminOrders from './views/admin/Orders.vue'

import Users from './views/admin/Users.vue'

import Products from './views/admin/products/ProductsIndex.vue';
import CreateProduct from './views/admin/products/CreateProduct.vue';
import EditProduct from './views/admin/products/EditProduct.vue';

import Cart from './views/cart/Cart.vue';
import Checkout from './views/cart/Checkout.vue';
import Success from './views/cart/Success.vue';
import Failure from './views/cart/Failure.vue';

import Orders from './views/orders/Orders.vue'
import ShowOrder from './views/orders/ShowOrder.vue'
import { useAuthStore } from './stores/auth';

const routes = [
    {
        path: '/',
        name: 'ShopLayout',
        component: Shop,
        children: [
            { path: '/', name: 'home', component: Home },
            { path: '/products/:product', name: 'showProduct', component: Product, props: true },
            // Auth routes
            { path: '/login', name: 'login', component: Login },
            { path: '/register', name: 'register', component: Register },
            { path: '/forgotPassword', name: 'forgotPassword', component: ForgotPassword },
            { path: '/password-reset/:token', name: 'password-reset', component: ResetPassword },
            // Cart routes
            { path: '/cart', name: 'cartIndex', component: Cart },
            { path: '/checkout', name: 'orderCheckout', component: Checkout },
            { path: '/checkout/success', name: 'checkoutSuccess', component: Success },
            { path: '/checkout/failure', name: 'checkoutFailure', component: Failure },
            // Orders routes
            { path: '/orders', name: 'ordersIndex', component: Orders },
            { path: '/orders/:order', name: 'showOrder', component: ShowOrder, props: true },
            // Profile routes
            { path: '/profile', name: 'profileIndex', component: Profile },
        ]
    },
];

// Admin panel routes
routes.push(
    {
        path: '/admin',
        name: 'adminIndex',
        component: Admin,
        children: [
            // Orders routes
            { path: 'orders', name: 'admin.orders', component: AdminOrders },
            { path: 'orders/view/:order', name: 'admin.showOrder', component: ShowOrder, props: true },
            // Users routes
            { path: 'users', name: 'admin.users', component: Users },
            // Products CRUD routes
            { path: 'products', name: 'admin.productsIndex', component: Products },
            { path: 'products/create', name: 'admin.createProduct', component: CreateProduct },
            { path: 'products/edit/:product', name: 'admin.editProduct', component: EditProduct, props: true },
        ]
    },
);

routes.push(
    { path: '/test', name: 'test', component: Test }
)

const router = createRouter({
    history: createWebHistory(),
    routes,
    scrollBehavior(to, from, savedPosition) {
        // always scroll to top
        return { top: 0 }
    },
});

router.beforeEach((to, from, next) => {
    const authStore = useAuthStore();

    let isAuthenticated = authStore.user;

    if (isAuthenticated && (to.name == 'login' || to.name == 'register')) {
        return next({
            name: 'dashboard'
        });
    }

    if (to.name == 'adminIndex') {
        if (isAuthenticated && authStore.user.id == 1) {
            return next({
                name: 'admin.orders'
            });
        } else {
            return next({
                name: 'home'
            });
        }
    }

    return next();
});


export default router;
