<?php

namespace App\Models\Shop\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategoryTree extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $table = 'product_category_tree';

    protected $fillable = ['product_id', 'category_id'];
}
