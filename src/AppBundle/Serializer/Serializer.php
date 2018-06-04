<?php
namespace AppBundle\Serializer;

use Doctrine\Common\Persistence\ObjectManager;

abstract class Serializer
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
        // Return result
        return json_encode($this->normalizeAll());
    }

    public function serialize(int $id)
    {
        // Normalize & return
        return json_encode($this->normalizeEntity($this->getEntity($id)));
    }

    public function normalizeAll()
    {
        // Get all entities
        $entities = $this->getEntities();

        // Loop on every match
        $return = [];
        foreach($entities as $entity){
            // Store object serialization
            $return[] = $this->normalizeEntity($entity);
        }

        return $return;
    }

    abstract protected function getEntities();
    abstract protected function getEntity(int $id);

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