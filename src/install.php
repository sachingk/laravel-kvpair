<?php
/**
 * Created by PhpStorm.
 * User: saching.kulkarni
 * Date: 2/24/2017
 * Time: 7:00 PM
 */

namespace sachingk\kvpair;

class install
{


    public static function postPackageInstall(){
        Artisan::call("php artisan vendor:publish --tag=lang");
        Artisan::call("php artisan vendor:publish --tag=config");
        Artisan::call("php artisan vendor:publish --tag=migrations");
    }
}