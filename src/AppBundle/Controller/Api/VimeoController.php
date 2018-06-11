<?php
namespace AppBundle\Controller\Api;

use AppBundle\Entity\Distant\Vimeo;
use AppBundle\Form\Type\Distant;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class VimeoController extends ApiController
{
    /**
     * @param Request $request
     * @return Response
     *
     * @Route("/add/vimeo/ajax", name="vimeo_ajax_upload")
     */
    public function ajaxAddAction(Request $request)
    {
        // Form
        $form = $this->createForm(Distant::class, new Vimeo());
        $form->handleRequest($request);

        $response = $this->handleAjaxAdd($form);

        return $this->renderAjax($response['code'], $response['content']);
    }

}