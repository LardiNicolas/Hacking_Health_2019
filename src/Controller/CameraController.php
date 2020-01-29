<?php

namespace App\Controller;

use App\Entity\Patient;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CameraController extends AbstractController
{
    /**
     * @Route("/photo/{id}", name="photo")
     */
    public function index($id = null)
    {

        $em = $this->getDoctrine()->getManager();
        $patient = $em->getRepository(Patient::class)->findOneBy(['id' => $id]);

        return $this->render('camera/index.html.twig', [
            'id' => $id,
        ]);
    }
}
