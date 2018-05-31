<?php
namespace AppBundle\Controller;

use AppBundle\Entity\Local\Image;
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
    public function uploadAction() {
        // Check if FILE is defined
        if(
            isset($_FILES['form']['tmp_name']) &&
            !empty($_FILES['form']['tmp_name'])
        ) {
            // Get ImageManager
            $ih = $this->getIh();
            // Upload
            $img = $ih->upload(
                $_POST['form']['name'],
                $_POST['form']['alt'],
                $_FILES['form']
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