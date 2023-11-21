<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $guarded = [];

    public $timestamps = null;

    use HasFactory;

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
