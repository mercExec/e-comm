<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    use HasFactory;
    use Sluggable;

    // Product status
    const HIDDEN = 1;
    const VISIBLE = 2;

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
                'includeTrashed' => true
            ]
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'id');
    }

    public function thumbnail()
    {
        return $this->hasOne(ProductImage::class, 'product_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }

}
