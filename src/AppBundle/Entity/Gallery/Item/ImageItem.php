<?php
namespace AppBundle\Entity\Gallery\Item;

use AppBundle\Entity\Gallery\Gallery;
use AppBundle\Entity\Local\Image;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class DailymotionItem
 * @package AppBundle\Entity\Gallery\Item
 *
 * @ORM\Entity()
 * @ORM\Table(name="gallery_item_image")
 */
class ImageItem extends GalleryItem
{

    /**
     * @var Gallery
     *
     * @ORM\ManyToOne(
     *     targetEntity="\AppBundle\Entity\Gallery\Gallery",
     *     inversedBy="imageItems"
     * )
     */
    private $gallery;

    /**
     * @var Image
     *
     * @ORM\ManyToOne(
     *     targetEntity="\AppBundle\Entity\Local\Image"
     * )
     */
    private $image;

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
     * @return Image
     */
    public function getImage(): Image
    {
        return $this->image;
    }

    /**
     * @param Image $image
     */
    public function setImage(Image $image): void
    {
        $this->image = $image;
    }

}