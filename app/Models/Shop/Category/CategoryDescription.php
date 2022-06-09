<?php

namespace  App\Models\Shop\Category;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryDescription extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $table = 'category_description';
    protected $primaryKey = 'category_id';

    protected $fillable = [
        'category_id',
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
