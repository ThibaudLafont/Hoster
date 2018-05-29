<?php
namespace AppBundle\Entity;

trait Hydrate
{
    /**
     * Hydrate an entity from array
     *
     * @param array $data
     */
    public function hydrate(array $data)
    {
        // Loop on every entry
        foreach ($data as $k => $v) {
            // If index is snake_case
            if($pos = strpos($k, "_")){
                $k = $this->snakeToCamel($k);
            }

            // Concat for get setter name
            $setter = "set" . ucfirst($k);

            // Execute method if exists
            if (method_exists($this, $setter)) {
                $this->$setter($v);
            }
        }
    }

    /**
     * Name converter
     * Convert snake_case to camelCase
     *
     * @param string $string
     * @return string
     */
    private function snakeToCamel(string $string)
    {
        // Init empty var
        $return = "";

        // Explode string by _
        $frags = explode('_', $string);

        // Loop on every frag
        foreach($frags as $frag){
            // ucfirst on frag and concat setter
            $return .= ucfirst($frag);
        }

        // lcfirst for real camelCase
        return lcfirst($return);
    }
}