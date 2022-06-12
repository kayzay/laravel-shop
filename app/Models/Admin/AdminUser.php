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

    public function groupRules()
    {
        return $this->hasManyThrough(
            AdminRule::class,
            AdminUserGroup::class,
                'id',
                'group_id',
                'id'
            )
            ->join('admin_politics', 'admin_politics.id', '=', 'admin_rules.admin_policy_id')
            ->select(
                'admin_politics.id as politics_id'
                , 'admin_politics.name as politics_name'
                , 'admin_rules.id'
                , 'admin_rules.admin_policy_id'
                , 'admin_rules.group_id'
                , 'admin_rules.rules'
                , 'admin_rules.admin_id'
                , 'admin_rules.created_at'
                , 'admin_rules.updated_at');
    }
}
