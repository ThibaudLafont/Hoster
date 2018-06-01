<?php
namespace AppBundle\Entity\Distant;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Dailymotion
 * @package AppBundle\Entity\Distant
 *
 * @ORM\Entity()
 * @ORM\Table(name="distant_dailymotion")
 * @ORM\EntityListeners({"AppBundle\EventListener\ItemListener", "AppBundle\EventListener\DailymotionListener"})
 */
class Dailymotion extends Distant
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
        return 'https://www.dailymotion.com/thumbnail/video/' . $this->getCode();
    }

    public function getEmbedSrc()
    {
        return 'https://www.dailymotion.com/video/' . $this->getCode();
    }

}