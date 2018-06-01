<?php
namespace AppBundle\EventListener;

use AppBundle\Entity\Item;
use AppBundle\Entity\Local\Image;
use AppBundle\Enumeration\Entity\LocalImageExtension;
use AppBundle\Service\ImageUploader;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;

/**
 * Class ItemListener
 *
 * @package AppBundle\EventListener
 */
class ImageListener
{

    /**
     * @var ImageUploader
     */
    private $uploader;

    /**
     * @var string
     */
    private $webUploadDir;

    public function __construct(ImageUploader $uploader, string $webUploadDir)
    {
        $this->setUploader($uploader);
        $this->setWebUploadDir($webUploadDir);
    }

    public function prePersist(Image $image, LifecycleEventArgs $event)
    {
        // Assign ext to Image
        $image->setExtension(
            LocalImageExtension::getValue($image->getFile()->getMimeType())
        );

        // Assign dir_path to image
        $image->setDirPath($this->getWebUploadDir());

        // Save file
        $this->getUploader()->save(
            $image->getFile()->getRealPath(),
            $image->getSlug(),
            $image->getExtension()
        );
    }

    public function preUpdate(Image $image, PreUpdateEventArgs $event)
    {
        if($event->hasChangedField('slug')) {
            // Generate old filename
            $oldFilename = $event->getOldValue('slug') . '.' . $image->getExtension();

            // Ask rename of image
            $this->getUploader()->rename($oldFilename, $image->getFilename());
        }
    }

    public function preRemove(Image $image, LifecycleEventArgs $event)
    {
        $this->getUploader()->delete(
            $image->getFilename()
        );
    }

    /**
     * @return ImageUploader
     */
    public function getUploader(): ImageUploader
    {
        return $this->uploader;
    }

    /**
     * @param ImageUploader $uploader
     */
    public function setUploader(ImageUploader $uploader): void
    {
        $this->uploader = $uploader;
    }

    /**
     * @return string
     */
    public function getWebUploadDir(): string
    {
        return $this->webUploadDir;
    }

    /**
     * @param string $webUploadDir
     */
    public function setWebUploadDir(string $webUploadDir): void
    {
        $this->webUploadDir = $webUploadDir;
    }

}
