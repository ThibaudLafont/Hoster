<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Media
 * @package AppBundle\Entity
 *
 * @ORM\Entity()
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({
 *     "media"="Media",
 *     "image" = "AppBundle\Entity\Local\Image",
 *     "vimeo" = "AppBundle\Entity\Distant\Vimeo",
 *     "youtube" = "AppBundle\Entity\Distant\Youtube",
 *     "dailymotion" = "AppBundle\Entity\Distant\Dailymotion",
 * })
 * @ORM\EntityListeners({"AppBundle\EventListener\ItemListener"})
 */
class Media
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(name="name", type="string")
     * @Assert\NotBlank(message="Le nom est obligatoire")
     */
    protected $name;

    /**
     * @var DateTime
     * @ORM\Column(name="create_at", type="datetime")
     */
    protected $createAt;

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
