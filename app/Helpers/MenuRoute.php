<?php

namespace App\Helpers;
use Request;

class MenuRoute {

    public static function active($route) {
        if( Request::is($route) || Request::is($route.'/*') || Request::is($route.'/*/*') ){
            return 'active';
        }
        return '';

    }
}