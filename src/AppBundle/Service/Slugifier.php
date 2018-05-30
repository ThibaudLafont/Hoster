<?php
namespace AppBundle\Service;

class Slugifier
{
    /**
     * Slugify a string chain
     *
     * @param $text
     * @return null|string|string[]
     */
    public function slugify($text)
    {
        $text = preg_replace('~[^\\pL\d]+~u', '-', $text);

        // trim
        $text = trim($text, '-');

        // transliterate
        if (function_exists('iconv')) {
            $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        }

        // lowercase
        $text = strtolower($text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        return $text;
    }
}