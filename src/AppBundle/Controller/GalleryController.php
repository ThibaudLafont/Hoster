<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class GalleryController extends Controller
{

    public function addAction(Request $request)
    {
        // Form
        $form = $this->createForm(Distant::class, new Dailymotion());
        $form->handleRequest($request);

        // Check if form was submitted
        if($form->isSubmitted() && $form->isValid()) {
            // Persist entity
            $em = $this->getDoctrine()->getManager();
            $em->persist($form->getData());
            $em->flush();

            // Return to image_upload
            return $this->redirectToRoute('dailymotion_add');
        }

        return $this->render(
            'distant/dailymotion/add.html.twig',
            ['vids' => $vids, 'form' => $form->createView()]
        );
    }

}