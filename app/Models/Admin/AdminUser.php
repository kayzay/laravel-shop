<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'status',
        'group_id',
        'password',
    ];

    public $timestamps = true;


    public function group()
    {
        return $this->belongsTo(AdminUserGroup::class, 'group_id', 'id');
    }
}
