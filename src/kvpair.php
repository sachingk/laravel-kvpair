<?php

namespace sachingk\kvpair;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use sachingk\kvpair\KVPairModel;
use Exception;
use Illuminate\Support\Facades\DB;
class KVPair
{

    /***
     * To Add Single KV Pair
     * @param $Key
     * @param $Value
     * @param $Description
     * @param $Group
     * @return bool
     */
    public static function addKVPair($Key, $Value, $Description, $Group)
    {

        if(!empty($Key) || !empty($Value) || !empty($Group)) {
            return false;
        }

        try {
            $NewKVPair = new KVPairModel();
            $NewKVPair->key = $Key;
            $NewKVPair->value = $Value;
            $NewKVPair->description = $Description;
            $NewKVPair->group = $Group;
            $Status = $NewKVPair->save();
            return $Status;
        }catch(Exception $e){
            return false;
        }
    }

    /***
     * To Add Multiple KV Pair at once
     * Example :
     *  $KVPairs = [
            ["key"=>"A1","value"=>"A1","description"=>"","group"=>"A"],
            ["key"=>"A2","value"=>"A2","description"=>"","group"=>"A"],
        ];
     * @param array $KeyValuePairs
     * @return bool
     */
    public static function addKVPairs($KeyValuePairs)
    {
        foreach($KeyValuePairs as $KeyValuePair) {

            if(!empty($KeyValuePair->key) || !empty($KeyValuePair->value) || !empty($KeyValuePair->group)) {
                return false;
            }
        }

        try {
            KVPairModel::insert($KeyValuePairs);
        }catch(Exception $e){
            return false;
        }
        return true;
    }


    /**
     * To get KV Pair by Key
     * @param $key
     * @return bool|object
     */
    public static function getKVPairByKey($key)
    {

        $Pair = KVPairModel::all(["key", "value", "description", "group"])->where("key", "=", $key)->toArray();
        return (isset($Pair) && !empty($Pair) == true ? (object)$Pair[0] : false);
    }

    /***
     * To get KV Pair by given array of keys
     * forDropDown option will give output which is ready to bind with <select> html control
     * @param $keys
     * @param bool $forDropDown
     * @return array|bool
     */
    public static function getKVPairByKeys($keys, $forDropDown = false)
    {
        $selectTxt = trans('kvpair_lang.select');
        $selectKey = config("kvpair.selectKey");

        if(config("kvpair.alwaysGetForDropdown") == true)  $forDropDown = true;

        if ($forDropDown == true) {
            $Pairs = array($selectKey => $selectTxt) + KVPairModel::whereIn("key", $keys)->pluck("key", "value")->toArray();
        } else {
            $Pairs = KVPairModel::all(["key", "value", "description", "group"])->whereIn("key", $keys)->toArray();
        }
        return (isset($Pairs) == true && !empty($Pairs) ? $Pairs : false);

    }

    /***
     * To get the KV pairs by given group
     * forDropDown option will give output which is ready to bind with <select> html control
     * @param $group
     * @param bool $forDropDown
     * @return array|bool
     */
    public static function getKVPairByGroup($group, $forDropDown = false)
    {
        $selectTxt = trans('kvpair_lang.select');
        $selectKey = config("kvpair.selectKey");

        if(config("kvpair.alwaysGetForDropdown") == true)  $forDropDown = true;

        if ($forDropDown == true) {
            $Pairs = array('' => $selectTxt) + KVPairModel::where("group", "=", $group)->pluck("key", "value")->toArray();
        } else {
            $Pairs = KVPairModel::all(["key", "value", "description", "group"])->where("group", "=", $group)->toArray();
        }
        return (isset($Pairs) == true && !empty($Pairs) ? $Pairs : false);
    }

    /***
     * To get KV pair by given groups
     * forDropDown option will give output which is ready to bind with <select> html control
     * @param $groups
     * @param bool $forDropDown
     * @return array|bool
     */
    public static function getKVPairByGroups($groups, $forDropDown = false)
    {
        $selectTxt = trans('kvpair_lang.select');
        $selectKey = config("kvpair.selectKey");

        if(config("kvpair.alwaysGetForDropdown") == true)  $forDropDown = true;

        if ($forDropDown == true) {
            $Pairs = array($selectKey => $selectTxt) + KVPairModel::whereIn("group", $groups)->pluck("key", "value")->toArray();
        } else {
            $Pairs = KVPairModel::all(["key", "value", "description", "group"])->whereIn("group", $groups)->toArray();
        }
        return (isset($Pairs) == true && !empty($Pairs) ? $Pairs : false);
    }

    /***
     * To get all the KV pairs
     * forDropDown option will give output which is ready to bind with <select> html control
     * @param bool $forDropDown
     * @return array|bool
     */
    public static function getAllKVPair($forDropDown = false)
    {
        $selectTxt = trans('kvpair_lang.select');
        $selectKey = config("kvpair.selectKey");

        if(config("kvpair.alwaysGetForDropdown") == true)  $forDropDown = true;

        if ($forDropDown == true) {
            $Pairs = array($selectKey => $selectTxt) + KVPairModel::pluck("key", "value")->toArray();
        } else {
            $Pairs = KVPairModel::all(["key", "value", "description", "group"])->toArray();
        }

        return (isset($Pairs) && !empty($Pairs) == true ? $Pairs : false);
    }


    /***
     * Delete a KV pair by given key
     * @param $key
     * @return bool
     */
    public static function deleteKVPairByKey($key)
    {
        $Status = KVPairModel::where("key","=",$key)->delete();
        return (boolean)$Status;
    }

    /***
     * Delete KV Pairs by given Keys
     * @param $keys
     * @return bool
     */
    public static function deleteKVPairByKeys($keys)
    {
        $Status = KVPairModel::whereIn("key",$keys)->delete();
        return (boolean)$Status;
    }

    /***
     * Delete KV Pairs by given group
     * @param $group
     * @return bool
     */
    public static function deleteKVPairByGroup($group)
    {
        $Status = KVPairModel::where("group","=",$group)->delete();
        return (boolean)$Status;
    }

    /***
     * Delete a KV pair by given groups
     * @param array $groups
     * @return bool
     */
    public static function deleteKVPairByGroups($groups)
    {
        $Status = KVPairModel::whereIn("group",$groups)->delete();
        return (boolean)$Status;
    }

    /***
     * Delete all KV pairs from the store
     * @return bool
     */
    public static function deleteAllKVPair()
    {
        $Status = KVPairModel::truncate();
        return (boolean)$Status;
    }


    /***
     * Gets count of all KV pairs by given group
     * @param $group
     * @return integer
     */
    public static function countKVPairByGroup($group)
    {
        $Count =   $Status = KVPairModel::where("group","=",$group)->count();
        return (int)$Count;
    }

    /***
     * Get count of all KV pairs by given groups
     * @param array $groups
     * @return integer
     */
    public static function countKVPairByGroups($groups)
    {
        $Count =   $Status = KVPairModel::whereIn("group",$groups)->count();
        return (int)$Count;
    }

    /***
     * Get count of all KV pairs from the store
     * @return integer
     */
    public static function countAllKVPair()
    {
        $Count =   $Status = KVPairModel::count();
        return (int) $Count;
    }

}