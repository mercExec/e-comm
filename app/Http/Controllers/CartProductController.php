<?php

namespace App\Http\Controllers;

use App\Models\CartProduct;
use App\Models\Product;
use App\Services\CartProductService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CartProductController extends Controller
{
    public function __construct(protected CartProductService $cartProductService)
    {
    }

    public function addProductToCart(Request $request, Product $product)
    {
        $this->cartProductService->addProductToCart($request, $product);

        return response()->json('product added to cart', 200);
    }

    public function getAllProducts(Request $request)
    {
        return $this->cartProductService->getAllProducts($request);
    }

    public function addCookieProductsToDB(Request $request)
    {
        return $this->cartProductService->addCookieProductsToDB($request);
    }

    public function deleteProductFromCookie(Request $request)
    {
        $cartProducts = json_decode($request->cart);
        $this->cartProductService->setCartCookie($cartProducts);

        return $this->cartProductService->getAllProducts($request);
    }

    public function deleteProductFromDB(Request $request, CartProduct $cartProduct)
    {
        $cartProduct->delete();

        return $this->cartProductService->getAllProducts($request);
    }

    public function updateQuantityInDB(Request $request, CartProduct $cartProduct)
    {
        $cartProduct->quantity = $request->quantity;
        $cartProduct->save();

        return response()->noContent();
    }

    public function updateQuantityInCookie(Request $request)
    {
        $cartProducts = json_decode($request->cart);

        $this->cartProductService->setCartCookie($cartProducts);

        return $this->cartProductService->getAllProducts($request);
    }
}
