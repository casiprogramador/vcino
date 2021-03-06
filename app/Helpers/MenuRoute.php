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
	
	public static function filename($route) {
		$filename_array = explode("-name-",$route);
		$nombre_archivo = (isset($filename_array[1]))? $filename_array[1] : '';
		return $nombre_archivo;
    }
}