<?php
namespace AppBundle\Controller;

use AppBundle\Entity\Local\Image;
use AppBundle\Form\Type\ImageUpload;
use AppBundle\Service\ImageHandler;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UploadController extends Controller
{
    /**
     * @var ImageHandler
     */
    private $ih;

    public function __construct(ImageHandler $ih)
    {
        $this->setIh($ih);
    }

    /**
     * @Route("/upload", name="upload")
     */
    public function uploadAction(Request $request) {
        // Form
        $form = $this->createForm(ImageUpload::class);
        $form->handleRequest($request);
        // Check if FILE is defined
        if(
            $form->isSubmitted()
//            isset($_FILES['form']['tmp_name']) &&
//            !empty($_FILES['form']['tmp_name'])
        ) {
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
        }

        // Render
        return $this->redirect('/');
    }

    /**
     * @param $id
     * @Route("/delete/{id}", name="delete")
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
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
        return $this->redirect('/');
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