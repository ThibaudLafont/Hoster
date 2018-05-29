<?php

namespace AppBundle\Controller;
use AppBundle\Entity\Local\Image;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // Get files
        $files = glob('/var/www/html/web/uploads/medias/images/*.jpg');

        // Get images
        $em = $this->getDoctrine()->getManager();
        $images = $em->getRepository(Image::class)->findAll();
//        foreach ($files as $image) {
//            $images[] = "/uploads/medias/images/"
//                . pathinfo($image, PATHINFO_FILENAME)
//                . '.'
//                . pathinfo($image, PATHINFO_EXTENSION)
//            ;
//        }

        // Render
        return $this->render(
            'default/form.html.twig',
            ['images' => $images]
        );
    }

}
