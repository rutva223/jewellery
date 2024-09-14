<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = [
        'id',
        'name',
        'status',
        'is_deleted'
    ];

    public function blogs()
    {
        return $this->hasMany(Blog::class, 'cat_id');
    }

    public function subCategories()
    {
        return $this->hasMany(SubCategory::class, 'cat_id', 'id');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'cat_id', 'id');
    }

}
