<?php

namespace App\View\Components;

use Illuminate\View\Component;

class selectBox extends Component
{
    private $name, $class, $data, $multiple, $selected;

    /**
     * Create a new component instance.
     *
     * @param $name
     * @param $data
     * @param bool $selected
     * @param bool $multiple
     * @param string $class
     */
    public function __construct($name, $data, $selected = false,  $multiple = false, $class = '')
    {
        $this->name = $name;
        $this->class = $class;
        $this->data = $data;
        $this->multiple = $multiple;
        $this->selected = $selected;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $old = old($this->name, false);
        $data = collect($this->data);
        $selected = $this->selected;
        if ($old) {
            $data = $data->transform(function ($item) use($old) {
                $item['selected'] = false;
                if ($item['id'] == $old) {
                    $item['selected'] = true;
                }

                return [
                    'id' => $item['id'],
                    'name' => $item['name'],
                    'selected' => $item['selected']
                ];
            });
        } else {
            $data = $data->transform(function ($item) use($selected) {
                if (!is_bool($selected) && $selected) {
                    $item['selected'] = is_array($selected)
                        ? in_array($item['id'], $selected)
                        : $item['id'] == $selected;
                }
                return [
                    'id' => $item['id'],
                    'name' => $item['name'],
                    'selected' => $item['selected']
                ];
            });
        }
        $data = [
            'data' =>$data->toArray()
            , 'name' => $this->name
            , 'class' => $this->class
            , 'multiple' => $this->multiple
        ];


        return view('admin.components.select-box', $data);
    }
}
