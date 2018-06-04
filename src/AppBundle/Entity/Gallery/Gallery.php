<?php
namespace AppBundle\Entity\Gallery;

use AppBundle\Entity\Gallery\Item\DailymotionItem;
use AppBundle\Entity\Gallery\Item\ImageItem;
use AppBundle\Entity\Gallery\Item\VimeoItem;
use AppBundle\Entity\Gallery\Item\YoutubeItem;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
use AppBundle\Form\Type\Gallery;
 * Class Gallery
 * @package AppBundle\Entity\Gallery
 *
 * @ORM\Entity()
 * @ORM\Table(name="gallery")
 */
class Gallery
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string")
     */
    private $title;

    /**
     * @var YoutubeItem
     *
     * @ORM\OneToMany(
     *     targetEntity="\AppBundle\Entity\Gallery\Item\YoutubeItem",
     *     mappedBy="gallery",
     *     cascade= {"persist"}
     * )
     */
    private $youtubeItems;

    /**
     * @var DailymotionItem
     *
     * @ORM\OneToMany(
     *     targetEntity="\AppBundle\Entity\Gallery\Item\DailymotionItem",
     *     mappedBy="gallery",
     *     cascade= {"persist"}
     * )
     */
    private $dailymotionItems;

    /**
     * @var VimeoItem
     *
     * @ORM\OneToMany(
     *     targetEntity="\AppBundle\Entity\Gallery\Item\VimeoItem",
     *     mappedBy="gallery",
     *     cascade= {"persist"}
     * )
     */
    private $vimeoItems;

    /**
     * @var ImageItem
     *
     * @ORM\OneToMany(
     *     targetEntity="\AppBundle\Entity\Gallery\Item\ImageItem",
     *     mappedBy="gallery",
     *     cascade= {"persist"}
     * )
     */
    private $imageItems;

    /**
     * @var Media
     */
    private $medias;

    public function __construct()
    {
        $this->youtubeItems = new ArrayCollection();
        $this->imageItems = new ArrayCollection();
        $this->dailymotionItems = new ArrayCollection();
        $this->vimeoItems = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return YoutubeItem
     */
    public function getYoutubeItems()
    {
        return $this->youtubeItems;
    }

    /**
     * @param $youtubeItems
     */
    public function setYoutubeItems($youtubeItems): void
    {
        $this->youtubeItems = $youtubeItems;
    }

    public function addYoutubeItem(YoutubeItem $youtubeItem): void
    {
        $this->youtubeItems->add($youtubeItem);
        $youtubeItem->setGallery($this);
    }

    /**
     * @return DailymotionItem
     */
    public function getDailymotionItems()
    {
        return $this->dailymotionItems;
    }

    /**
     * @param $dailymotionItems
     */
    public function setDailymotionItems($dailymotionItems): void
    {
        $this->dailymotionItems = $dailymotionItems;
    }

    public function addDailymotionItem(DailymotionItem $dailymotionItem): void
    {
        $this->dailymotionItems->add($dailymotionItem);
        $dailymotionItem->setGallery($this);
    }

    /**
     * @return VimeoItem
     */
    public function getVimeoItems()
    {
        return $this->vimeoItems;
    }

    /**
     * @param $vimeoItems
     */
    public function setVimeoItems($vimeoItems): void
    {
        $this->vimeoItems = $vimeoItems;
    }

    public function addVimeoItem(VimeoItem $vimeoItem): void
    {
        $this->vimeoItems->add($vimeoItem);
        $vimeoItem->setGallery($this);
    }

    /**
     * @return ImageItem
     */
    public function getImageItems()
    {
        return $this->imageItems;
    }

    /**
     * @param $imageItems
     */
    public function setImageItems($imageItems): void
    {
        $this->imageItems = $imageItems;
    }

    public function addImageItem(ImageItem $imageItem): void
    {
        $this->imageItems->add($imageItem);
        $imageItem->setGallery($this);
    }

    /**
     * @return Media
     */
    public function getMedias()
    {
        return $this->medias;
    }

    /**
     * @param Media $medias
     */
    public function setMedias($medias): void
    {
        $this->medias = $medias;
    }

}