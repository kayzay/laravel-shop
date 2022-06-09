<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminStatus extends Model
{
    use HasFactory;

    public const ADMIN_STATUS_ACTIVE = 1;
    public const ADMIN_STATUS_INACTIVE = 2;
    public const ADMIN_STATUS_BLOCKED = 3;

    protected $table = 'admin_status';
}
