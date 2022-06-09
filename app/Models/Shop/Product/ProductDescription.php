<?php

namespace App\Models\Shop\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDescription extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $table = 'product_description';
    protected $primaryKey = 'product_id';

    protected $fillable = [
        'product_id',
        'language_id',
        'name',
        'h1',
        'keywords',
        'title',
        'description',
        'short_description',
        'full_description'
    ];
}
