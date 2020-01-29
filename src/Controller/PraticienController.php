<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\PatientType;
use App\Form\RegistrationFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/praticien")
 */
class PraticienController extends AbstractController
{
    /**
     * @Route("/", name="praticien")
     */
    public function index()
    {
        return $this->render('praticien/index.html.twig', [
            'particiens' => $this->getDoctrine()->getRepository(User::class)->findAll(['orderBy' => 'ASC'])
        ]);
    }

    /**
     * @Route("/edit/", name="praticien_edit")
     * @Route("/edit/{id}", name="praticien_edit_id")
     */
    public function edit($id = null, Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {

        $user = new User();
        if(!is_null($id)){
            $em = $this->getDoctrine()->getManager();
            $user = $em->getRepository(User::class)->findOneBy(['id' => $id]);
        }
        
        // @TODO Il faut refaire un fichier RegistrationFormType que pour l'édition (copier/coller le fichier et réadapter un peu le contenu)

        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $encoded = $passwordEncoder->encodePassword(
                $user,
                $form->get('plainPassword')->getData()
            );

            $user->setRoles(['USER_ROLE']);
            $user->setPassword($encoded);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            // do anything else you need here, like send an email

            return $this->redirectToRoute('praticien');
        }

        return $this->render('patient/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
