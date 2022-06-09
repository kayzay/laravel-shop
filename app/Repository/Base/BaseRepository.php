<?php
namespace App\Repository\Base;

abstract class BaseRepository
{
    protected $model;

    /**
     * @return Illuminate\Database\Eloquent\Model;
     */
    protected function getCondition()
    {
        return new $this->model();
    }

    protected function setModel($name)
    {
        $this->model = $name;
    }
}
