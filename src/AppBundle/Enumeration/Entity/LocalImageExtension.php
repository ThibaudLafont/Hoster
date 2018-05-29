<?php
namespace AppBundle\Enumeration\Entity;

use AppBundle\Enumeration\Enumeration;

class LocalImageExtension
{
    /**
     * Constants keys for DB persists
     */
    const PNG = "image/png";
    const JPEG = "image/jpeg";
    const JPG = "image/jpg";

    /**
     * String to display by cont key
     *
     * @var array
     */
    private static $values = [
        self::PNG => "png",
        self::JPEG => "jpg",
        self::JPG => "jpg"
    ];

    // Traits
    use Enumeration;

    /**
     * Return the differents availables keys
     *
     * @return array
     */
    public static function getAvailableTypes() : array
    {
        return [
            self::PNG,
            self::JPEG,
            self::JPG
        ];
    }
}