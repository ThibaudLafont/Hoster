<?php
namespace AppBundle\EventSubscriber;

use AppBundle\Service\Slugifier;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class YoutubeSubscriber implements EventSubscriberInterface
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

        // If no data ; youtube_add
        if(is_null($data)) {
            $form->add(
                'submit',
                SubmitType::class, [
                    'label' => 'Ajouter'
                ]
            );
        // Else, youtube_edit
        } else {
            $form->add(  // Upload button
                'Modifier',
                SubmitType::class, [
                    'label' => 'Modifier'
                ]
            );
        }
    }
}
