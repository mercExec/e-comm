<?php

namespace App\Services;

use App\Models\CartProduct;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class CartProductService
{
    protected function addProductToDB($user, Product $product)
    {
        // adding existing product while authenticated adds the same product to cart instead of increasing quantity
        $userCartProducts = self::getAllProductsFromDb($user);

        $productFound = false;

        foreach ($userCartProducts as &$userCartProduct) {
            // Check if added product exists in user's cart. If so, add +1 to quantity.
            if ($userCartProduct->product_id === $product->id) {
                $userCartProduct->quantity += 1;
                $userCartProduct->save();
                $productFound = true;
                break;
            }
        }

        // Add product to user's cart if it doesn't exist
        if (!$productFound) {
            $user->cartProducts()->create([
                'user_id' => $user->id,
                'product_id' => $product->id,
                'quantity' => 1
            ]);
        }
    }

    protected function addProductToCookie(Request $request, Product $product)
    {
        // Get cart products from cookie
        $cartProducts = self::getAllCartProductsFromCookie($request);

        $productFound = false;

        foreach ($cartProducts as &$cartProduct) {
            // If added product exists in cart, add +1 to quantity
            if ($cartProduct['product_id'] === $product->id) {
                $cartProduct['quantity'] += 1;
                $productFound = true;
                break;
            }
        }

        // If product doesn't exist, add it to cart cookie
        if (!$productFound) {
            $cartProducts[] = [
                'user_id' => null,
                'product_id' => $product->id,
                'quantity' => 1,
            ];
        }

        self::setCartCookie($cartProducts);
    }

    public function setCartCookie($cart)
    {
        Cookie::queue('cartProducts', json_encode($cart), 60 * 24 * 30);
    }

    public function addProductToCart(Request $request, Product $product)
    {
        if (Auth::check()) {
            self::addProductToDB($request->user(), $product);
        } else {
            self::addProductToCookie($request, $product);
        }
    }

    protected function getAllProductsFromDb(User $user)
    {
        $cartProducts = $user->cartProducts->toArray();

        return self::getProductsByIds($cartProducts, 'db');
    }

    public function getAllProductsFromCookie(Request $request)
    {
        $cartProducts = self::getAllCartProductsFromCookie($request);

        return self::getProductsByIds($cartProducts, 'cookie');
    }

    protected function getProductsByIds($cartProducts, $cartProductsSource)
    {
        // Get the ids from cart products
        // If a user is authenticated, products will be returned
        $ids = array_map(function ($cartProduct) use ($cartProductsSource) {
            if ($cartProductsSource == 'db') {
                return \is_object($cartProduct) ? $cartProduct->id : $cartProduct['id'];
            } else {
                return \is_object($cartProduct) ? $cartProduct->product_id : $cartProduct['product_id'];
            }
        }, $cartProducts);

        // Return cart product with product relationship if user is authenticated. If not, return product and add quantity from the cookie to it
        if ($cartProductsSource == 'db') {
            $cartProducts = CartProduct::whereIn('id', $ids)->with(['product.thumbnail'])->get();

            return $cartProducts;
        } else {
            $products =  Product::whereIn('id', $ids)->with(['thumbnail'])->get();
            foreach ($cartProducts as &$cartProduct) {
                foreach ($products as $product) {
                    if ($cartProduct['product_id'] == $product->id) {
                        $cartProduct['product'] = $product;
                        break;
                    }
                }
            }
            return $cartProducts;
        }
    }

    protected function getAllCartProductsFromCookie(Request $request)
    {
        return json_decode($request->cookie('cartProducts', '[]'), true);
    }

    public function getAllProducts(Request $request)
    {
        if (Auth::check()) {
            $products = self::getAllProductsFromDb($request->user());
        } else {
            $products = self::getAllProductsFromCookie($request);
        }

        return $products;
    }

    public function addCookieProductsToDB(Request $request)
    {
        $cookieProducts = self::getAllProductsFromCookie($request);

        $userCartProducts = $request->user()->cartProducts;

        $userProductsIds = [];

        foreach ($userCartProducts as $cartProduct) {
            \array_push($userProductsIds, $cartProduct->product_id);
        }

        foreach ($cookieProducts as $cookieProduct) {
            // Only add cookie product to DB if it doesn't exist in the user's cart products in the DB
            if (!\in_array($cookieProduct['product_id'], $userProductsIds)) {
                $request->user()->CartProducts()->create([
                    'user_id' => $request->user()->id,
                    'product_id' => $cookieProduct['product_id'],
                    'quantity' => $cookieProduct['quantity'],
                ]);
            }
        }

        // Destroy cookie
        \Cookie::queue(\Cookie::forget('cartProducts'));

        return self::getAllProductsFromDb($request->user());
    }
}
