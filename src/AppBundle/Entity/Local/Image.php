<?php
namespace AppBundle\Entity\Local;

use AppBundle\Entity\Item;
use AppBundle\Enumeration\Entity\LocalImageExtension;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Image
 *
 * @ORM\Entity()
 * @ORM\Table(name="local_image")
 * @ORM\EntityListeners({"AppBundle\EventListener\ItemListener", "AppBundle\EventListener\ImageListener"})
 * @UniqueEntity("slug", message="Nom déjà pris")
 */
class Image extends Item
{
    /**
     * @var UploadedFile
     */
    private $file;

    /**
     * @var string
     * @ORM\Column(name="slug", type="string")
     */
    private $slug;

    /**
     * @var string
     * @ORM\Column(name="extension", type="string")
     */
    private $extension;

    /**
     * @var string
     * @ORM\Column(name="dir_path", type="string")
     */
    private $dirPath;

    /**
     * @return int
     */
    public function getWidth(): int
    {
        return getimagesize(
            '/var/www/html/web'.$this->getSrc()
        )[0];
    }

    /**
     * @return int
     */
    public function getHeight(): int
    {
        return getimagesize(
            '/var/www/html/web'.$this->getSrc()
        )[1];
    }

    public function filesize()
    {
        // Convert size in Ko
        $size =
            round(
                (filesize('/var/www/html/web'.$this->getSrc()) / 1000),
                2
            );

        // Clear cache
        clearstatcache();
        // Return result
        return $size . ' Kb';
    }

    public function getSrc()
    {
        return
            $this->getDirPath()  .
            $this->getFilename();
        ;
    }

    public function getThumbSrc()
    {
        return
            $this->getDirPath() . 'thumbnails/' .
            $this->getFilename();
    }

    public function getFilename()
    {
        return $this->getSlug() . '.' . $this->getExtension();
    }

    /**
     * @return string
     */
    public function getExtension(): string
    {
        return $this->extension;
    }

    /**
     * @param string $extension
     */
    public function setExtension(string $extension): void
    {
        if (
            !in_array($extension, ['jpg', 'jpeg', 'png'])
        ) {
            throw new \InvalidArgumentException("Invalid Local Image extension");
        }

        // Assign extension
        $this->extension = $extension;
    }

    /**
     * @return string
     */
    public function getDirPath(): string
    {
        return $this->dirPath;
    }

    /**
     * @param string $dirPath
     */
    public function setDirPath(string $dirPath): void
    {
        $this->dirPath = $dirPath;
    }

    /**
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     */
    public function setSlug(string $slug): void
    {
        $this->slug = $slug;
    }

    /**
     * @return UploadedFile
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file): void
    {
        $this->file = $file;
    }

}