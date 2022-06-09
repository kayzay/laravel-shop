<?php

namespace App\Helpers\Traits;

trait Instanced {

    private static $instance = null;

    /**
     * @return Instanced|$this
     */
    public static function getInstance()
    {
        if(self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function __clone()
    {

    }

}
