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
    public static function getSubscribedEvents()
    {
        return [
            FormEvents::PRE_SET_DATA => 'handleFormBuild'
        ];
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
                    'submit',
                    SubmitType::class, [
                        'label' => 'Ajouter'
                    ]
                )
            ;
            // Else, image_edit
        } else {
            $form->add(  // Edit button
                'Modifier',
                SubmitType::class, [
                    'label' => 'Modifier'
                ]
            );
        }
    }
}
