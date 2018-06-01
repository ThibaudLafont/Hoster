<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * Media
 *
 * @ORM\MappedSuperclass()
 * @ORM\EntityListeners({"AppBundle\EventListener\ItemListener"})
 */
abstract class Item
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
     * @ORM\Column(name="name", type="string")
     */
    private $name;

    /**
     * @var string
     * @ORM\Column(name="alt", type="string")
     */
    private $alt;

    /**
     * @var DateTime
     * @ORM\Column(name="create_at", type="datetime")
     */
    private $createAt;

    // Traits
    use Hydrate;

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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
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

    /**
     * @return \DateTime
     */
    public function getCreateAt(): \DateTime
    {
        return $this->createAt;
    }

    /**
     * @param \DateTime $createAt
     */
    public function setCreateAt(\DateTime $createAt): void
    {
        $this->createAt = $createAt;
    }

}