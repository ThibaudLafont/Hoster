<?php
namespace AppBundle\Enumeration;

trait Enumeration
{
    /**
     * Permit to get a value related to a key
     *
     * @param $key string
     *
     * @return mixed|string
     */
    public static function getValue(string $key) : string
    {
        if (!isset(self::$values[$key])) {
            return "Unknow " . get_called_class();
        } else {
            return self::$values[$key];
        }
    }
}