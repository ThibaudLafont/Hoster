<?php
namespace AppBundle\Entity\Distant;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Vimeo
 * @package AppBundle\Entity\Distant
 *
 * @ORM\Entity()
 * @ORM\Table(name="distant_vimeo")
 * @ORM\EntityListeners({"AppBundle\EventListener\ItemListener", "AppBundle\EventListener\VimeoListener"})
 */
class Vimeo extends Distant
{
    /**
     * @var string
     * @ORM\Column(name="cover_url", type="string")
     */
    private $coverUrl;

    public function getCoverImage()
    {
        return $this->coverUrl;
    }

    public function getEmbedSrc()
    {
        return 'https://player.vimeo.com/video/' . $this->getCode();
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