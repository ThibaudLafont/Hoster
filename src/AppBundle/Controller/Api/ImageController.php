<?php
namespace AppBundle\Controller\Api;

use AppBundle\Entity\Distant\Youtube;
use AppBundle\Form\Type\Distant;
use AppBundle\Form\Type\Image;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class ImageController extends ApiController
{
    /**
     * @param Request $request
     * @return Response
     *
     * @Route("/add/image/ajax", name="image_ajax_upload")
     */
    public function ajaxAddAction(Request $request)
    {
        // Form
        $form = $this->createForm(Image::class);
        $form->handleRequest($request);

        $response = $this->handleAjaxAdd($form);

        return $this->renderAjax($response['code'], $response['content']);
    }

}