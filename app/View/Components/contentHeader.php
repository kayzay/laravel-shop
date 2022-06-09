<?php

namespace App\View\Components;

use Illuminate\View\Component;

class contentHeader extends Component
{
    private $name;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $data['h1'] = (empty($this->name)) ? getTextAdmin('h1') : $this->name;
        return view('admin.components.content-header', $data);
    }
}
