<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    protected $table = 'sub_categories';

    protected $fillable = [
        'id',
        'name',
        'name_slug',
        'cat_id',
        'status',
        'is_deleted',
    ];

    public function blogs()
    {
        return $this->hasMany(Blog::class, 'sub_cat_id');
    }

    public function category()
{
    return $this->belongsTo(Category::class, 'cat_id', 'id');
}

}
