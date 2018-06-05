<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Media
 *
 * @ORM\Entity()
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({
 *     "item"="Item",
 *     "image" = "AppBundle\Entity\Local\Image",
 *     "vimeo" = "AppBundle\Entity\Distant\Vimeo",
 *     "youtube" = "AppBundle\Entity\Distant\Youtube",
 *     "dailymotion" = "AppBundle\Entity\Distant\Dailymotion",
 * })
 * @ORM\EntityListeners({"AppBundle\EventListener\ItemListener"})
 */
class Item
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
     * @Assert\NotBlank(message="Le nom est obligatoire")
     */
    private $name;

    /**
     * @var string
     * @ORM\Column(name="alt", type="string")
     * @Assert\NotNull(message="La description est obligatoire")
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
    public function getId()
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
    public function getCreateAt()
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