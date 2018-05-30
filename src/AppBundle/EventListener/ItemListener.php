<?php
namespace AppBundle\EventListener;

use AppBundle\Entity\Item;

/**
 * Class ItemListener
 *
 * @package AppBundle\EventListener
 */
class ItemListener
{
    /**
     * Upload Local file to webserver
     *
     * @param Item $item
     */
    public function prePersist($item)
    {
        // Create now DateTime with good TimeZone
        $createAt = new \DateTime(
            'now',
            new \DateTimeZone('Europe/Paris')
        );

        // Assign createAt
        $item->setCreateAt($createAt);
    }
}
