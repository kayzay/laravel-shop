<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminRule extends Model
{
    use HasFactory;

    protected $fillable = [
        'admin_policy_id',
        'group_id',
        'rules',
        'admin_id'
    ];

    public $timestamps = true;

    public const PERMISSION_SHOW = 'show';
    public const PERMISSION_CREATE = 'create';
    public const PERMISSION_UPDATE = 'update';
    public const PERMISSION_DELETE = 'delete';

    public const RULES = [
        'show' => 1 << 0,
        'create' => 1 << 1,
        'update' => 1 << 2,
        'delete' => 1 << 3,
    ];

    public function policies()
    {
        return $this->hasMany(AdminPolicy::class, 'admin_policy_id', 'id');
    }
}
