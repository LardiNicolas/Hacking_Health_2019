<?php

namespace App\Controller;

use App\Entity\Patient;
use App\Entity\Photo;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UploadController extends AbstractController
{
    /**
     * @Route("/upload/{id}", name="upload")
     */
    public function index($id = null, Request $request)
    {

        $blob = $request->get('image');

        if(!empty($blob)){

            $em = $this->getDoctrine()->getManager();
            $patient = $em->getRepository(Patient::class)->findOneBy(['id' => $id]);

            // open the output file for writing
            $uniqid = uniqid();
            $ifp = fopen( 'upload/'.$uniqid.'.png', 'wb' );

            $data = explode( ',', $blob );

            // we could add validation here with ensuring count( $data ) > 1
            fwrite( $ifp, base64_decode( $data[ 1 ] ) );

            // clean up the file resource
            fclose( $ifp );

            $image = new Photo();
            $image->setName($uniqid);
            $image->setId($patient);
            $image->setIduser($user = $this->getUser());

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($image);
            $entityManager->flush();


        }

        return $this->render('upload/index.html.twig', [
            'controller_name' => 'UploadController',
            'image' => $ifp
        ]);
    }
}
