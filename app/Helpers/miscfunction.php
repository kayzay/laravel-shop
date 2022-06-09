<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

if (! function_exists('dbg ')) {
   function dbg($value) {
       $trece = debug_backtrace()[0];
       dump([$trece['file'] ." LINE: " . $trece['line'], $value]);
   }
}


if (! function_exists('getTextAdmin')) {

    function getTextAdmin($variable, $folder = null) {
        if ($folder === null) {
            static $fileName;

            if (empty($fileName)) {
                $alias = str_replace('.', '\\', Request::route()->getName());
                $fileName = "admin\\" . $alias;
            }
        } else {
            $fileName = "admin\\" . $folder;
        }

        return __("{$fileName}.{$variable}");
    }
}

if (! function_exists('getAdminMenuText')) {

    function getAdminMenuText($variable)
    {
        static $fileName;

        if(empty($fileName)) {
            $fileName = "admin\\menu" ;
        }

        return __("{$fileName}.{$variable}");
    }
}

if (! function_exists('adminAuth')) {
    /**
     * @return \Illuminate\Contracts\Auth\Guard|\Illuminate\Contracts\Auth\StatefulGuard
     */
    function adminAuth()
    {

        return Auth::guard('admin');
    }
}

