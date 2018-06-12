<?php
namespace AppBundle\Entity\Gallery;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Config\Definition\Exception\InvalidTypeException;

/**
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
     * @var ArrayCollection
     *
     * @ORM\OneToMany(
     *     targetEntity="Item",
     *     mappedBy="gallery",
     *     cascade={"persist"},
     *     orphanRemoval=true
     * )
     * @ORM\OrderBy({"position" = "ASC"})
     */
    private $items;

    /**
     * @var ArrayCollection
     */
    private $newItems;

    /**
     * @var Media
     */
    private $medias;

    public function __construct()
    {
        $this->medias = new ArrayCollection();
        $this->items = new ArrayCollection();
        $this->newItems = new ArrayCollection();
    }

    public function getItemsNbre()
    {
        return $this->getItems()->count();
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

    /**
     * @return ArrayCollection
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @param Item $items
     */
    public function setItems($items): void
    {
        $this->items = $items;
    }

    public function addItem(Item $item)
    {
        $this->items->add($item);
        $item->setGallery($this);
    }

    public function removeItem(Item $item)
    {
        $this->items->removeElement($item);
        $item->setGallery(null);
    }

    /**
     * @return ArrayCollection
     */
    public function getNewItems()
    {
        return $this->newItems;
    }

    /**
     * @param ArrayCollection $newItems
     */
    public function setNewItems($newItems): void
    {
        $this->newItems = $newItems;
    }

    public function addNewItem($item) {
        $this->newItems->add($item);
    }

}