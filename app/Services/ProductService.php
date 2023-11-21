<?php

namespace App\Services;

use App\Models\ProductImage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class ProductService
{
    public function handleUploadedImages($images, $productId)
    {
        foreach ($images as $uploadedImage) {
            ProductImage::create([
                'url' => $uploadedImage->store('images/products', 'public'),
                'product_id' => $productId
            ]);
        }
    }

    public function countImages($imagesCount, $images)
    {
        $validator = Validator::make($images,
        [
            'newImages' => ['nullable', 'max:5'],
            'newImages.*' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:5120','dimensions:min_width=100,min_height=100,max_width=5000,max_height=5000']
        ]);

        // Return with error if overall images exceed 5 images
        if ($imagesCount > 5) {
            return response()->json(['errors' => ['newImages' => ['Only 5 images are allowed']], 'status' => 422], 422);
        }
        // Return with error if no images are available
        else if ($imagesCount == 0) {
            return response()->json(['errors' => ['newImages' => ['You must upload at least 1 image']], 'status' => 422], 422);
        }

        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors(), 'status' => 422], 422);
        }

        return null;
    }

    public function handleUpdatedImages($oldImages, $deletedImages)
    {
        $deletedImages = array_filter($oldImages, function($oldImage) use ($deletedImages) {
            return in_array($oldImage['url'], $deletedImages);
        });

        // Delete images (if any exist) from database and storage
        if ($deletedImages) {
            foreach ($deletedImages as $image) {
                if(File::exists('storage/' . $image['url'])) {
                    File::delete('storage/' . $image['url']);
                }

                ProductImage::findOrFail($image['id'])->delete();
            }
        }
    }

    public function forceDeleteImages($images)
    {
        if ($images) {
            foreach ($images as $image) {
                if(File::exists('storage/' . $image->url)) {
                    File::delete('storage/' . $image->url);
                }
            }
        }
    }
}