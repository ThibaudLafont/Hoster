<?php
namespace AppBundle\Controller;

use AppBundle\Entity\Local\Image;
use AppBundle\Form\Type\ImageUpload;
use AppBundle\Service\ImageHandler;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class ImageController extends Controller
{
    /**
     * @var ImageHandler
     */
    private $ih;

    /**
     * @param ImageHandler $ih
     */
    public function __construct(ImageHandler $ih)
    {
        $this->setIh($ih);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     *
     * @Route("/add/image", name="image_upload")
     */
    public function uploadAction(Request $request) {
        // Form
        $form = $this->createForm(ImageUpload::class);
        $form->handleRequest($request);

        // Check if form was submitted
        if($form->isSubmitted()) {
            $this->handleUploadFormSubmit($form);
        }

        // Render
        return $this->redirectToRoute('image_add');
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
        if($form->isSubmitted()) {
            // Handle upload
            $image = $this->handleUploadFormSubmit($form);

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

        // Check if form was submitted
        if($form->isSubmitted()) {

            // Rename file though listener

            // Edits Entity

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

        // Delete file
        $this->getIh()->delete($image);

        // Delete Entity
        $em->remove($image);
        $em->flush();

        // Render
        return $this->redirectToRoute('image_add');
    }

    /**
     * Perform upload & persist entity to DB
     *
     * @param FormInterface $form
     * @return Image
     */
    private function handleUploadFormSubmit(FormInterface $form)
    {
        // Get Datas
        $data = $form->getData();

        // Get ImageManager
        $ih = $this->getIh();
        // Upload
        $img = $ih->upload(
            $data['name'],
            $data['alt'],
            $data['image']
        );

        // Persist new entity
        $em = $this->getDoctrine()->getManager();
        $em->persist($img);
        $em->flush();

        // return entity
        return $img;
    }

    /**
     * @return ImageHandler
     */
    public function getIh(): ImageHandler
    {
        return $this->ih;
    }

    /**
     * @param ImageHandler $ih
     */
    public function setIh(ImageHandler $ih): void
    {
        $this->ih = $ih;
    }

}