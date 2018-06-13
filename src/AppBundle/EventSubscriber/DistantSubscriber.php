<?php
namespace AppBundle\EventSubscriber;

use AppBundle\Service\Slugifier;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class DistantSubscriber implements EventSubscriberInterface
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

        // If no data ; distant_add
        if(is_null($data) || is_null($data->getName())) {
            $form->add(
                'submit',
                SubmitType::class, [
                    'label' => 'Ajouter'
                ]
            );
        // Else, distant_edit
        } else {
            $form->add(  // Upload button
                'submit',
                SubmitType::class, [
                    'label' => 'Modifier'
                ]
            );
        }
    }
}
