<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';

    protected $fillable = [
        'id',
        'cat_id',
        'product_name',
        'product_slug',
        'images',
        'product_price',
        'sell_price',
        'discount',
        'quantity',
        'description',
        'status',
        'is_deleted'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'cat_id');
    }

    public function getImagesAttribute($value)
    {
        // Define the base URL for images
        $image_url = config("global.website_url") . 'product_image/';
        $filenames = json_decode($value, true);
        if (is_array($filenames)) {

            $full_urls = array_map(function($filename) use ($image_url) {
                return $image_url . $filename;
            }, $filenames);

            return $full_urls;
        }
        return [];
    }
}
