<?php
namespace AppBundle\Service;

use AppBundle\Entity\Local\Image;
use AppBundle\Enumeration\Entity\LocalImageExtension;

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
        Uploader $uploader,
        Slugifier $slugifier,
        string $webUploadDir
    )
    {
        $this->setUploader($uploader);
        $this->setSlugifier($slugifier);
        $this->setImageDir($webUploadDir);
    }

    public function upload(string $name, string $alt, array $files)
    {
        // Define extension
        $ext = LocalImageExtension::getValue($files['type']['image']);
        // Define Slug
        $slug = $this->getSlugifier()->slugify($name);

        // Save Image
        $this->getUploader()->save(
            $files['tmp_name']['image'], $slug, $ext
        );

        // Entity creation
        return $this->createImage([
            'name' => $name,
            'slug' => $slug,
            'filename' => explode('/', $files['tmp_name']['image'])[2],
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
     * @return Uploader
     */
    public function getUploader(): Uploader
    {
        return $this->uploader;
    }

    /**
     * @param Uploader $uploader
     */
    public function setUploader(Uploader $uploader): void
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