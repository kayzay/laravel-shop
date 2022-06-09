<?php

namespace App\Models\Shop\Category;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $fillable = [
        'parent_id',
        'alias',
        'img',
        'status'
    ];

    public function description()
    {
        return $this->belongsTo(CategoryDescription::class, 'id', 'category_id');

    }

    public function descriptions()
    {
        return $this->hasMany(CategoryDescription::class);
    }
}
