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
     * @ORM\Column(name="url", type="string")
     */
    private $url;

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

}