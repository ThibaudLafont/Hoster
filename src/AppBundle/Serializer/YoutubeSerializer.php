<?php
namespace AppBundle\Serializer;

use AppBundle\Entity\Distant\Youtube;
use Doctrine\Common\Persistence\ObjectManager;

class YoutubeSerializer implements SerializerInterface
{
    /**
     * @var ObjectManager
     */
    private $em;

    public function __construct(ObjectManager $em)
    {
        $this->setEm($em);
    }

    public function serializeAll()
    {
        // Get all entities
        $entities = $this->getEntities();

        // Loop on every match
        $return = [];
        foreach($entities as $entity){
            // Store object serialization
            $return[] = $this->normalizeEntity($entity);
        }

        // Return result
        return $return;
    }

    public function serialize(int $id)
    {
        // Find entity
        $entity = $this->getEm()->getRepository(Youtube::class)
            ->find($id);

        // Normalize & return
        return $this->normalizeEntity($entity);
    }

    private function getEntities()
    {
        return $this->getEm()->getRepository(Youtube::class)
            ->findAll();
    }

    private function normalizeEntity(Youtube $entity)
    {
        return [
            'type' => 'youtube',
            'id'   => $entity->getId(),
            'name' => $entity->getName(),
            'thumbnail'  => $entity->getCoverImage()
        ];
    }

    /**
     * @return ObjectManager
     */
    public function getEm(): ObjectManager
    {
        return $this->em;
    }

    /**
     * @param ObjectManager $em
     */
    public function setEm(ObjectManager $em): void
    {
        $this->em = $em;
    }
}