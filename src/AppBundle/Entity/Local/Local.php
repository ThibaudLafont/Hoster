<?php
namespace AppBundle\Entity\Local;

use AppBundle\Entity\Media;
use Doctrine\ORM\Mapping as ORM;

abstract class Local extends Media
{
    /**
     * @var string
     * @ORM\Column(name="extension", type="string")
     */
    protected $extension;

    /**
     * @var string
     * @ORM\Column(name="dir_path", type="string")
     */
    protected $dirPath;

    public function getSrc()
    {
        return
            $this->getDirPath()  .
            $this->getFilename();
        ;
    }

    public function getFilename()
    {
        return $this->getSlug() . '.' . $this->getExtension();
    }

    /**
     * @return string
     */
    public function getExtension()
    {
        return $this->extension;
    }

    /**
     * @param string $extension
     */
    abstract public function setExtension(string $extension);

    /**
     * @return string
     */
    public function getDirPath()
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

}