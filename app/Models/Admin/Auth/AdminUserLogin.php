<?php

namespace App\Models\Admin\Auth;

use App\Models\Admin\AdminRule;
use App\Models\Admin\AdminUserGroup;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class AdminUserLogin extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'status',
        'group_id',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $table = 'admin_users';



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
