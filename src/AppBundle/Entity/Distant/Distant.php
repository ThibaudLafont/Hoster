<?php
namespace AppBundle\Entity\Distant;

use AppBundle\Entity\Item;
use AppBundle\Entity\Media;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Media
 *
 * @UniqueEntity("slug", message="Nom déjà pris")
 */
abstract class Distant extends Media
{
    /**
     * @var string
     * @ORM\Column(name="url", type="string")
     * @Assert\Url(
     *     message="L'URL fournie n'est pas valide",
     *     checkDNS="ANY",
     *     dnsMessage="L'url fournie est invalide"
     * )
     */
    protected $url;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string")
     */
    protected $code;

    abstract function getSrc();
    abstract function isFromCorrectHost();

    public function getIconClass()
    {
        return 'ui video icon';
    }

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