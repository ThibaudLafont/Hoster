<?php
namespace AppBundle\Entity\Distant;

use AppBundle\Entity\Item;
use Doctrine\ORM\Mapping as ORM;

/**
 * Media
 *
 * @ORM\MappedSuperclass()
 */
abstract class Distant extends Item
{
    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string")
     */
    private $code;

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param string $code
     */
    public function setCode(string $code): void
    {
        $this->code = $code;
    }

}