<?php

namespace App\Models\Admin;

use App\Http\Requests\Admin\Group\ReqestGroup;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminPolicy extends Model
{
    use HasFactory;

    protected  $table = "admin_politics";

    public const POLICY_CATEGORIES = 1;//Categories
    public const POLICY_PRODUCTS = 2;//Products
    public const POLICY_ATTRIBUTES = 3;//Attributes
    public const POLICY_OPTIONS = 4;//Options
    public const POLICY_ADMIN_USERS = 5;//AdminUsers
    public const POLICY_ADMIN_USER_GROUPS = 6;//AdminUserGroups
    public const POLICY_USER = 7;//User
    public const POLICY_USER_GROUPS = 8;//UserGroups
    public const POLICY_PRICES = 9;//Prices
    public const POLICY_ORDERS = 10;//Orders
    public const POLICY_CURRENCIES = 11;//Currencies
    public const POLICY_LANGUAGES = 12;//Languages
    public const POLICY_LOG = 13;//Logs
    public const POLICY_PROMO = 13;//Promo


    public $timestamps = true;


}
