<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 02/02/2018
 * Time: 15:15
 */

namespace App\Utils\Helpers;


class Data
{
    /**
     * @param $data
     *
     * @return bool
     */
    public static function isSerializedObject($data)
    {
        return !is_object($data) && preg_match('/^O:/', $data) === 1;
    }


    public static function convertToObject($data)
    {

        if (self::isSerializedObject($data)) {
            return unserialize($data);
        }

        return $data;
    }
}
