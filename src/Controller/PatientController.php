<?php

namespace App\Controller;

use App\Entity\Patient;
use App\Form\PatientType;
use App\Form\RegistrationFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class PatientController extends AbstractController
{
    /**
     * @Route("/patient", name="patient")
     */
    public function index(Security $security)
    {
        return $this->render('patient/index.html.twig', [
            'controller_name' => 'PatientController',
            'patients' => $this->getDoctrine()->getRepository(Patient::class)->findAll(['orderBy' => 'ASC'])
        ]);
    }

    /**
     * @Route("/patient/{id}/galerie", name="patient_galerie")
     */
    public function galerie($id = null)
    {

        $galeries = $this->getDoctrine()->getRepository(Patient::class)->findAll(['orderBy' => 'ASC']);

        return $this->render('patient/galerie.html.twig', [
            'patients' => $this->getDoctrine()->getRepository(Patient::class)->findAll(['orderBy' => 'ASC'])
        ]);
    }

    /**
     * @Route("/patient/edit/", name="patient_edit")
     * @Route("/patient/edit/{id}", name="patient_edit_id")
     */
    public function edit($id = null, Request $request)
    {

        $user = new Patient();
        if(!is_null($id)){
            $em = $this->getDoctrine()->getManager();
            $user = $em->getRepository(Patient::class)->findOneBy(['id' => $id]);
        }

        $form = $this->createForm(PatientType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            // do anything else you need here, like send an email

            return $this->redirectToRoute('patient');
        }

        return $this->render('patient/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
