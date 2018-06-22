<?php
namespace AppBundle\Entity\Distant;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Vimeo
 * @package AppBundle\Entity\Distant
 *
 * @ORM\Entity()
 * @ORM\Table(name="media_distant_vimeo")
 * @ORM\EntityListeners({"AppBundle\EventListener\ItemListener", "AppBundle\EventListener\VimeoListener"})
 */
class Vimeo extends Distant
{
    /**
     * @var string
     * @ORM\Column(name="cover_url", type="string")
     */
    private $coverUrl;

    public function getThumbnail()
    {
        return $this->coverUrl;
    }

    public function getSrc()
    {
        return 'https://player.vimeo.com/video/' . $this->getCode();
    }

    public function getType()
    {
        return 'vimeo';
    }

    /**
     * @return bool|int
     *
     * @Assert\IsTrue(message="L'url fournie ne dirige pas vers Vimeo")
     */
    function isFromCorrectHost()
    {
        return strpos($this->getUrl(), 'vimeo') > 0;
    }

    /**
     * @return string
     */
    public function getCoverUrl(): string
    {
        return $this->coverUrl;
    }

    /**
     * @param string $coverUrl
     */
    public function setCoverUrl(string $coverUrl): void
    {
        $this->coverUrl = $coverUrl;
    }
}