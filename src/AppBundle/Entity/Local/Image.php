<?php
namespace AppBundle\Entity\Local;

use AppBundle\Entity\Item;
use AppBundle\Enumeration\Entity\LocalImageExtension;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Image
 *
 * @ORM\Entity()
 * @ORM\Table(name="media_local_image")
 * @ORM\EntityListeners({"AppBundle\EventListener\ItemListener", "AppBundle\EventListener\ImageListener"})
 * @UniqueEntity("slug", message="Nom déjà pris", groups={"create", "Default"})
 */
class Image extends Local
{
    /**
     * @var UploadedFile
     * @Assert\Image(
     *     maxSize="1M",
     *     maxSizeMessage="Le fichier est trop lourd ({{ size }} {{ suffix }}), la taille maximale autorisée est {{ limit }} {{ suffix }}",
     *     uploadFormSizeErrorMessage="Le fichier fourni est trop lourd",
     *     mimeTypes={"image/jpeg", "image/jpg", "image/png"},
     *     mimeTypesMessage="{{ type }} n'est pas supporté, veuillez uploader une des types suivants: {{ types }}",
     *     uploadErrorMessage="Problème durant l'upload",
     *     notReadableMessage="Fichier illisible",
     *     uploadIniSizeErrorMessage="Le fichier fourni est trop lourd",
     *     notFoundMessage="Fichier introuvable",
     *     detectCorrupted=true,
     *     corruptedMessage="Le fichier est corrompu",
     *     groups={"create"}
     * )
     * @Assert\NotNull(message="Le fichier est obligatoire", groups={"create"})
     */
    private $file;

    /**
     * @var string
     * @ORM\Column(name="alt", type="string")
     * @Assert\NotNull(message="La description est obligatoire", groups={"create", "Default"})
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "Your first name must be at least {{ limit }} characters long",
     *      maxMessage = "Your first name cannot be longer than {{ limit }} characters",
     *      groups={"create", "Default"}
     * )
     */
    private $alt;

    public function getType()
    {
        return 'image';
    }

    public function getIconClass()
    {
        return 'ui camera icon';
    }

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

    public function getThumbnail()
    {
        return
            $this->getDirPath() . 'thumbnails/' .
            $this->getFilename();
    }

    /**
     * @param string $extension
     */
    public function setExtension(string $extension): void
    {
        // Assign extension
        $this->extension = $extension;
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

    /**
     * @return string
     */
    public function getAlt()
    {
        return $this->alt;
    }

    /**
     * @param string $alt
     */
    public function setAlt(string $alt): void
    {
        $this->alt = $alt;
    }

}