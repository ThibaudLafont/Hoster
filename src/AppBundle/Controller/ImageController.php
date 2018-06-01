<?php
namespace AppBundle\Controller;

use AppBundle\Entity\Local\Image;
use AppBundle\Form\Type\ImageUpload;
use AppBundle\Service\ImageHandler;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class ImageController extends Controller
{
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     *
     * @Route("/add/image", name="image_upload")
     */
    public function uploadAction(Request $request) {
        // Get images
        $em = $this->getDoctrine()->getManager();
        $images = $em->getRepository(Image::class)->findAll();

        // Form
        $form = $this->createForm(ImageUpload::class);
        $form->handleRequest($request);

        // Check if form was submitted
        if($form->isSubmitted() && $form->isValid()) {
            // Persist entity
            $em = $this->getDoctrine()->getManager();
            $em->persist($form->getData());
            $em->flush();

            // Return to image_upload
            return $this->redirectToRoute('image_upload');
        }

        // Render
        return $this->render(
            'image/add.html.twig',
            [
                'images' => $images,
                'form'   => $form->createView()
            ]
        );
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     *
     * @Route("/add/image/ajax", name="image_ajax_upload")
     */
    public function ajaxUploadAction(Request $request)
    {
        // Form
        $form = $this->createForm(ImageUpload::class);
        $form->handleRequest($request);

        // Check if FILE is defined
        if($form->isSubmitted() && $form->isValid()) {
            // Persist entity
            $em = $this->getDoctrine()->getManager();
            $em->persist($form->getData());
            $em->flush();

            // Build Response
            $response = new Response();
            $response->setContent(json_encode(['url' => 'http://hoster.lan' . $image->getSrc()]));
            $response->headers->set('Content-Type', 'application/json');
            $response->headers->set('Access-Control-Allow-Origin', '*');

            // Return Response
            return $response;
        }

        // Else return 400
        return new Response('Problème d\'uplaod', 400, ['Access-Control-Allow-Origin' => '*']);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     *
     * @Route("/edit/image/{id}", name="image_edit")
     */
    public function editAction(Request $request, $id)
    {
        // Get Image
        $em = $this->getDoctrine()->getManager();
        $image = $em->getRepository(Image::class)->find($id);

        // Form
        $form = $this->createForm(ImageUpload::class, $image);
        $form->handleRequest($request);

        //Name Check if form was submitted
        if($form->isSubmitted() && $form->isValid()) {
            // Update Entity (launch Listener)
            $this->getDoctrine()->getManager()->flush();
        }

        // Render
        return $this->render(
            'image/edit.html.twig',
            ['image' => $image, 'form' => $form->createView()]
        );
    }

    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     *
     * @Route("/delete/image/{id}", name="image_delete")
     */
    public function deleteAction($id)
    {
        // Get Image
        $em = $this->getDoctrine()->getManager();
        $image = $em->getRepository(Image::class)->find($id);

        // Delete Entity
        $em->remove($image);
        $em->flush();

        // Render
        return $this->redirectToRoute('image_upload');
    }

}