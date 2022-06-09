<?php

namespace App\View\Components;

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
        $data['menuItems'] = [
           getAdminMenuText( 'catalog') => [
                [
                    'name' => getAdminMenuText( 'name_category'),
                    'link' => route('category.index')
                ],
                [
                    'name' => getAdminMenuText( 'name_product'),
                    'link' => route('product.index')
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
                 getAdminMenuText( 'sales') => [
                     [
                         'name' => getAdminMenuText( 'name_orders'),
                         'link' => ''//route('categories')
                     ]
                 ],
                 getAdminMenuText( 'customers') => [
                     [
                         'name' => getAdminMenuText( 'name_customers'),
                         'link' => ''//route('categories')
                     ],
                     [
                         'name' => getAdminMenuText( 'name_customer_group'),
                         'link' => ''//route('categories')
                     ],
                 ],
                 getAdminMenuText( 'admin_list') => [

                         [
                             'name' => getAdminMenuText( 'name_admin_customer'),
                             'link' => route('admin.users.index')
                         ],
                         [
                             'name' =>  getAdminMenuText( 'name_admin_customer_grup'),
                             'link' =>  route('admin.group.index')
                         ],

                 ],
          // 'Marketing' =>  '',//route('categories'),
            'System' => [
                'Localisation' => [
                         [
                             'name' => 'Language List',
                             'link' => route('system.language.index')
                         ],
                         [
                             'name' => 'Currency List',
                             'link' => route('system.currency.index')
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

        return view('admin.components.left-menu', $data);
    }
}
