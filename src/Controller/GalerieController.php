<?php

namespace App\Controller;

use App\Entity\Patient;
use App\Entity\Photo;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/galerie")
 */
class GalerieController extends AbstractController
{
    /**
     * @Route("/", name="gallerie")
     */
    public function index()
    {
        return $this->render('galerie/index.html.twig', [
            'controller_name' => 'GallerieController',
        ]);
    }

    /**
     * @Route("/{id}/praticien", name="gallerie_by_praticien")
     */
    public function pratitien($id = null)
    {
        $em = $this->getDoctrine()->getManager();
        $photos = $em->getRepository(Photo::class)->findBy(['idUser' => $id]);

        return $this->render('galerie/photos.html.twig', [
            'photos' => $photos
        ]);
    }

    /**
     * @Route("/{id}", name="gallerie_by_patient")
     */
    public function patient($id = null)
    {
        $em = $this->getDoctrine()->getManager();
        $photos = $em->getRepository(Photo::class)->findBy(['id' => $id]);

        return $this->render('galerie/photos.html.twig', [
            'photos' => $photos
        ]);
    }
}
