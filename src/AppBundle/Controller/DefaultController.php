<?php

namespace AppBundle\Controller;
use AppBundle\Entity\Local\Image;
use AppBundle\Form\Type\ImageUpload;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/image", name="image_add")
     */
    public function addImageAction(Request $request)
    {
        // Get images
        $em = $this->getDoctrine()->getManager();
        $images = $em->getRepository(Image::class)->findAll();

        // Build form
        $form = $this->createForm(ImageUpload::class);

        // Render
        return $this->render(
            'image/add.html.twig',
            [
                'images' => $images,
                'form'   => $form->createView()
            ]
        );
    }

    public function addYoutubeAction(Request $request)
    {
        // Get images
        $em = $this->getDoctrine()->getManager();
        $images = $em->getRepository(Image::class)->findAll();

        // Build form
        $form = $this->createForm(ImageUpload::class);

        // Render
        return $this->render(
            'distant/youtube/add.html.twig',
            [
                'images' => $images,
                'form'   => $form->createView()
            ]
        );
    }

}
