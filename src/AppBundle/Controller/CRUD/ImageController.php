<?php
namespace AppBundle\Controller\CRUD;

use AppBundle\Entity\Local\Image;
use \AppBundle\Form\Type\Image as ImageType;
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
    public function addAction(Request $request) {
        // Get images
        $em = $this->getDoctrine()->getManager();
        $images = $em->getRepository(Image::class)->findAll();

        // Form
        $form = $this->createForm(ImageType::class);
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
        $form = $this->createForm(ImageType::class, $image);
        $form->handleRequest($request);

        //Name Check if form was submitted
        if($form->isSubmitted() && $form->isValid()) {
            // Update Entity (launch Listener)
            $this->getDoctrine()->getManager()->flush();
        }

        // Render
        return $this->render(
            'default/edit.html.twig',
            [
                'type' => 'Image',
                'media' => $image,
                'form' => $form->createView()
            ]
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