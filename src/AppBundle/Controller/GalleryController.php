<?php
namespace AppBundle\Controller;

use AppBundle\Entity\Gallery\Gallery as GalleryEntity;
use AppBundle\Form\Type\Gallery;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class GalleryController extends Controller
{

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     *
     * @Route("/add/gallery", name="gallery_add")
     */
    public function addAction(Request $request)
    {
        // Form
        $form = $this->createForm(Gallery::class, new GalleryEntity());
        $form->handleRequest($request);

        // Check if form was submitted
        if($form->isSubmitted() && $form->isValid()) {
            echo '<pre>'; var_dump($form->getData()); die;
            // Persist entity
//            $em = $this->getDoctrine()->getManager();
//            $em->persist($form->getData());
//            $em->flush();

            // Return to image_upload
            return $this->redirectToRoute('gallery_add');
        }

        return $this->render(
            'gallery/add.html.twig',
            ['form' => $form->createView()]
        );
    }

}