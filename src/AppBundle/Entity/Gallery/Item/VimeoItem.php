<?php
namespace AppBundle\Entity\Gallery\Item;

use AppBundle\Entity\Distant\Vimeo;
use AppBundle\Entity\Gallery\Gallery;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class VimeoItem
 * @package AppBundle\Entity\Gallery\Item
 *
 * @ORM\Entity()
 * @ORM\Table(name="gallery_item_vimeo")
 */
class VimeoItem extends GalleryItem
{

    /**
     * @var Gallery
     *
     * @ORM\ManyToOne(
     *     targetEntity="\AppBundle\Entity\Gallery\Gallery",
     *     inversedBy="vimeoItems"
     * )
     */
    private $gallery;

    /**
     * @var Vimeo
     *
     * @ORM\ManyToOne(
     *     targetEntity="\AppBundle\Entity\Distant\Vimeo"
     * )
     */
    private $vimeo;

    /**
     * @return Gallery
     */
    public function getGallery(): Gallery
    {
        return $this->gallery;
    }

    /**
     * @param Gallery $gallery
     */
    public function setGallery(Gallery $gallery): void
    {
        $this->gallery = $gallery;
    }

    /**
     * @return Vimeo
     */
    public function getVimeo(): Vimeo
    {
        return $this->vimeo;
    }

    /**
     * @param Vimeo $vimeo
     */
    public function setVimeo(Vimeo $vimeo): void
    {
        $this->vimeo = $vimeo;
    }

}