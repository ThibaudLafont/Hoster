<?php
namespace AppBundle\Service;

use AppBundle\Entity\Local\Image;
use AppBundle\Enumeration\Entity\LocalImageExtension;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ImageHandler
{
    /**
     * @var Uploader
     */
    private $uploader;

    /**
     * @var Sluggifier
     */
    private $slugifier;

    /**
     * @var string
     */
    private $imageDir;

    public function __construct(
        ImageUploader $uploader,
        Slugifier $slugifier,
        string $webUploadDir
    )
    {
        $this->setUploader($uploader);
        $this->setSlugifier($slugifier);
        $this->setImageDir($webUploadDir);
    }

    public function upload(string $name, string $alt, UploadedFile $file)
    {
        // Define extension
        $ext = LocalImageExtension::getValue($file->getMimeType());
        // Define Slug
        $slug = $this->getSlugifier()->slugify($name);

        // Save Image
        $this->getUploader()->save(
            $file->getRealPath(), $slug, $ext
        );

        // Entity creation
        return $this->createImage([
            'name' => $name,
            'slug' => $slug,
            'extension' => $ext,
            'alt' => $alt,
            'dirPath' => $this->getImageDir()
        ]);
    }

    public function delete(Image $image)
    {
        // Ask to Uploader deletion
        $this->getUploader()->delete(
            $image->getSlug() . '.' . $image->getExtension()
        );
    }

    private function createImage(array $data)
    {
        $entity = new Image();
        $entity->hydrate($data);
        return $entity;
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
     * @return Slugifier
     */
    public function getSlugifier(): Slugifier
    {
        return $this->slugifier;
    }

    /**
     * @param Slugifier $slugifier
     */
    public function setSlugifier(Slugifier $slugifier): void
    {
        $this->slugifier = $slugifier;
    }

    /**
     * @return string
     */
    public function getImageDir(): string
    {
        return $this->imageDir;
    }

    /**
     * @param string $imageDir
     */
    public function setImageDir(string $imageDir): void
    {
        $this->imageDir = $imageDir;
    }

}