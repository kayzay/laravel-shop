<?php

namespace App\Models\Shop\Price;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $fillable = [
        'name', 'abr', 'symbol',
        'use', 'default', 'course'
    ];

  //  protected $table = 'currencies';
}

