<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 02/02/2018
 * Time: 15:15
 */

namespace App\Component\Helpers;

/**
 * Class Data
 *
 * @package App\Component\Helpers
 */
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

    public static function doesSubstringExist($string, $substring): bool
    {
        if (!strlen($substring) && !strlen($substring)) {
            throw new \LogicException('Both string and substring are required');
        }

        return (strpos($string, $substring) !== false);
    }

    public function getAfterSubstring($string, $substring): string
    {
        if (strpos($string, $substring) !== false) {
            return substr($string, strpos($string, $substring) + 1);
        }

        return $string;
    }

    public function getBeforeSubstring($string, $substring): string
    {
        if (strpos($string, $substring) !== false) {
            return substr($string, 0, strpos($string, $substring));
        }

        return $string;
    }
}
