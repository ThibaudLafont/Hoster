<?php

namespace AppBundle\Controller;
use AppBundle\Entity\Local\Image;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // Get images
        $em = $this->getDoctrine()->getManager();
        $images = $em->getRepository(Image::class)->findAll();

        // Build form
        $form = $this->createFormBuilder()
            ->setAction('/upload')
            ->add('name', TextType::class)
            ->add('alt', TextType::class)
            ->add('image', FileType::class)
            ->add('Uploader', SubmitType::class)
            ->getForm();

        // Render
        return $this->render(
            'default/form.html.twig',
            [
                'images' => $images,
                'form'   => $form->createView()
            ]
        );
    }

}
