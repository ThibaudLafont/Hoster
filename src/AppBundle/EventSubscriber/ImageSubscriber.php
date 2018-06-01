<?php
namespace AppBundle\EventSubscriber;

use AppBundle\Service\Slugifier;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class ImageSubscriber implements EventSubscriberInterface
{

    /**
     * @var Sluggifier
     */
    private $slugifier;

    public function __construct(Slugifier $sluggifier)
    {
        $this->setSlugifier($sluggifier);
    }

    public static function getSubscribedEvents()
    {
        return [
            FormEvents::PRE_SUBMIT => 'slugifyImageName',
            FormEvents::PRE_SET_DATA => 'handleFormBuild'
        ];
    }

    public function slugifyImageName(FormEvent $event)
    {
        // Get data
        $image = $event->getData();

        // Generate&Assign slugName
        $image['slug'] = $this->getSlugifier()->slugify($image['name']);

        // Set datas to event
        $event->setData($image);
    }

    public function handleFormBuild(FormEvent $event)
    {
        // Get data
        $form = $event->getForm();
        $data = $event->getData();

        // If no data ; image_upload
        if(is_null($data)) {
            $form
                ->add(  // Show file input
                    'file',
                    FileType::class
                )
                ->add(  // Upload button
                    'Uploader',
                    SubmitType::class
                )
            ;
            // Else, image_edit
        } else {
            $form->add(  // Edit button
                'Modifier',
                SubmitType::class
            );
        }
    }

    /**
     * Get Slugifier
     *
     * @return Slugifier
     */
    public function getSlugifier(): Slugifier
    {
        return $this->slugifier;
    }

    /**
     * Set Slugifier
     *
     * @param Slugifier $slugifier
     */
    public function setSlugifier(Slugifier $slugifier)
    {
        $this->slugifier = $slugifier;
    }
}
