<?php

namespace App\View\Components;

use App\Facades\Admin\AdminAuthRules;
use App\Models\Admin\AdminPolicy;
use App\Models\Admin\AdminRule;
use Illuminate\View\Component;

class leftMenu extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function getAdminMenuTextconstruct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $data['menuItems'] = $this->bild($this->menuItems());

        return view('admin.components.left-menu', $data);
    }

    private function menuItems()
    {
        return [
            getAdminMenuText('catalog') => [
                [
                    'name' => getAdminMenuText('name_category'),
                    'link' => route('category.index'),
                    'permission' => $this->checkRule(AdminPolicy::POLICY_CATEGORIES)
                ],
                [
                    'name' => getAdminMenuText('name_product'),
                    'link' => route('product.index'),
                    'permission' => $this->checkRule(AdminPolicy::POLICY_PRODUCTS)
                ]
            ],
            /*getAdminMenuText( 'attributes') => [
                [
                 'name' => getAdminMenuText( 'name_attribute'),
                 'link' => ''//route('categories')
                ],
                [
                 'name' => getAdminMenuText( 'name_attribute_grup'),
                 'link' => ''//route('categories')
                ]
             ],*/

            // getAdminMenuText( 'option') => '',//route('categories'),
            // getAdminMenuText( 'information') => '',//route('categories'),
            getAdminMenuText('sales') => [
                [
                    'name' => getAdminMenuText('name_orders'),
                    'link' => '', //route('categories'),
                    'permission' => $this->checkRule(AdminPolicy::POLICY_ORDERS)
                ]
            ],
            getAdminMenuText('customers') => [
                [
                    'name' => getAdminMenuText('name_customers'),
                    'link' => '',//route('categories'),
                    'permission' => $this->checkRule(AdminPolicy::POLICY_USER)
                ],
                [
                    'name' => getAdminMenuText('name_customer_group'),
                    'link' => '',//route('categories'),
                    'permission' => $this->checkRule(AdminPolicy::POLICY_USER_GROUPS)
                ],
            ],
            getAdminMenuText('admin_list') => [

                [
                    'name' => getAdminMenuText('name_admin_customer'),
                    'link' => route('admin.users.index'),
                    'permission' => $this->checkRule(AdminPolicy::POLICY_ADMIN_USERS)
                ],
                [
                    'name' => getAdminMenuText('name_admin_customer_grup'),
                    'link' => route('admin.group.index'),
                    'permission' => $this->checkRule(AdminPolicy::POLICY_ADMIN_USER_GROUPS)
                ],

            ],
            // 'Marketing' =>  '',//route('categories'),
            'System' => [
                'Localisation' => [
                    [
                        'name' => 'Language List',
                        'link' => route('system.language.index'),
                        'permission' => $this->checkRule(AdminPolicy::POLICY_LANGUAGES)
                    ],
                    [
                        'name' => 'Currency List',
                        'link' => route('system.currency.index'),
                        'permission' => $this->checkRule(AdminPolicy::POLICY_CURRENCIES)
                    ],
                ],
                /*'Maintenance' => [
                         [
                             'name' => 'log',
                             'link' => ''//route('categories')
                         ]
                     ]*/
            ]
        ];

    }

    private function bild($data)
    {
        $items = [];
        foreach ($data as $key => $datum) {
            if (isset($datum['permission'])) {
                if ($datum['permission']) {
                    if (is_string($key)) {
                        $items[$key] = $datum;
                    } else {
                        $items[] = $datum;
                    }

                }
            } elseif (is_string($key)) {
                $menuItem = $this->bild($datum);
                if (!empty($menuItem)) {
                    $items[$key] = $menuItem;
                }
            }
        }

        return $items;
    }

    private function checkRule($policy)
    {
        if (!AdminAuthRules::isAdmin()) {
            AdminAuthRules::setAdmin(adminAuth()->user()->load('groupRules'));
        }

        $policy = AdminAuthRules::getPolicy($policy);

        return AdminAuthRules::check($policy, AdminRule::PERMISSION_SHOW);
    }
}
