<?php

namespace App\Models\Admin;

use App\Http\Requests\Admin\Group\ReqestGroup;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminUserGroup extends Model
{
    use HasFactory;

    protected $table = 'admin_user_group';

    protected $fillable = [
        'name'
    ];

    public $timestamps = true;

    public function roles()
    {
        return $this->hasMany(AdminRule::class, 'group_id', 'id');
    }
}
