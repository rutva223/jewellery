<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $table = 'blogs';

    protected $fillable = [
        'id',
        'cat_id',
        'sub_cat_id',
        'title',
        'title_slug',
        'image',
        'headline',
        'description',
        'status',
        'is_deleted'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'cat_id');
    }

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class, 'sub_cat_id');
    }

    public function getImageAttribute($value)
    {
        $image_url = config("global.website_url") . 'blog_image/';
        if ($value) {
            return $image_url . $value;
        } else {
            return null;
        }
    }

}
