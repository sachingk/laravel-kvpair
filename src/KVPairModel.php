<?php
/**
 * Created by PhpStorm.
 * User: saching.kulkarni
 * Date: 2/24/2017
 * Time: 9:43 PM
 */

namespace sachingk\kvpair;

use Illuminate\Database\Eloquent\Model;

class KVPairModel extends Model
{
    public $table = "kvpair";

    public $fillable = [
        "key",
        "value",
        "description",
        "group"
    ];


    public static $rules = [
        "key" => "required",
        "value" => "required",
        "group" => "required"
    ];
}