<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(protected ProductService $productService)
    {
    }

    public function index()
    {
        return Product::with(['thumbnail'])->paginate(15);
    }

    public function store(StoreProductRequest $request)
    {
        $product = Product::create($request->safe()->except('images'));

        $product = $product->fresh();

        if ($request->hasFile('images')) {
            $this->productService->handleUploadedImages($request->file('images'), $product->id);
        }

        return \response()->json("Product Created");
    }

    public function update(StoreProductRequest $request, Product $product)
    {
        $formFields = $request->safe()->except(['images', 'newImages', 'deletedImages']);

        try {
            // Count overall images (Old images + new uploaded images - deleted images)
            $countImages = count($product->images) + count($request->file('newImages') ?? []) - count($request->input('deletedImages') ?? []);
            $countImagesResponse = $this->productService->countImages($countImages, $request->file('newImages') ?? []);
            if ($countImagesResponse !== null) {
                return $countImagesResponse;
            }

            // Check if any old images are deleted and delete them
            $deletedImages = $request->input('deletedImages');
            if ($deletedImages) {
                $this->productService->handleUpdatedImages($product->images->toArray(), $deletedImages);
            }

            // Check if any new images are uploaded and upload them
            if ($request->hasFile('newImages')) {
                $this->productService->handleUploadedImages($request->file('newImages'), $product->id);
            }

            $product->fill($formFields);
            $product->timestamps = false;
            $product->save();

            return \response()->json("Product Updated");
        } catch (Exception $e) {
            return response()->json(['errors' => ['newImages' => $e->getMessage()]], 422);
        }
    }

    public function show(Product $product)
    {
        $product->load('images');
        return response()->json($product);
    }

    public function destroy(Product $product)
    {
        $this->productService->forceDeleteImages($product->images);
        $product->delete();
        return \response()->json("Product deleted");
    }
}
