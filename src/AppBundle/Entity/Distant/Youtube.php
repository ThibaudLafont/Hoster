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

}