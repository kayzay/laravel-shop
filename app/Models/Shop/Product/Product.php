<?php

namespace App\Models\Shop\Product;

use App\Models\Shop\Category\CategoryDescription;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $fillable = [
        'img', 'alias', 'sort',
        'quantity', 'status', 'price'
    ];

  //  protected $table = 'products';

    public function description()
    {
        return $this->belongsTo(ProductDescription::class, 'id', 'product_id');

    }

    public function descriptions()
    {
        return $this->hasMany(ProductDescription::class);
    }

    public function category()
    {
        return $this->hasManyThrough(
            CategoryDescription::class,
            ProductCategoryTree::class,
            'product_id',
            'category_id',
            'id',
            'category_id'
        );
    }
}
