<?php
if (! function_exists('getPageContent ')) {

    function getPageContent($variable)
    {
       static $pageName;

       if(empty($pageName)) {
            $requst = request();
            $alias = str_replace("/admin/", '', $requst->getRequestUri());
            $pageName = "component\\head\\" . $alias;

       }

       return __($pageName . '.' . $variable);
    }
}
