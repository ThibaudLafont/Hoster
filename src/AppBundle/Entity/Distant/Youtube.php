<?php
namespace AppBundle\Entity\Distant;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Youtube
 * @package AppBundle\Entity\Distant
 *
 * @ORM\Entity()
 * @ORM\Table(name="distant_youtube")
 * @ORM\EntityListeners({"AppBundle\EventListener\ItemListener", "AppBundle\EventListener\YoutubeListener"})
 */
class Youtube extends Distant
{
    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string")
     */
    private $code;

    public function getCoverImage()
    {
        return 'https://img.youtube.com/vi/' .
            $this->getCode() .
            '/hqdefault.jpg';
    }

    public function getEmbedSrc()
    {
        return 'https://www.youtube.com/embed/' . $this->getCode();
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