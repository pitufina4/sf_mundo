<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use App\Entity\Pais;
use App\Form\PaisType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;


/**
* @Route("/pais")
*/
class PaisController extends Controller
{


    /**
     * @Route("/nuevo", name="pais")
     */
    public function nuevo()
    {
       $pais = new pais();

        $formu = $this->createForm(PaisType::class, $pais);
        $formu->handleRequest($request);

        if ($formu->isSubmitted()) {


            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($pais);
            $entityManager->flush();
        

            return $this->redirectToRoute('pais_lista');      
                        
        }

        return $this->render('pais/index.html.twig', [
            'controller_name' => 'PaisController',
        ]);
    }


    /**
     * @Route("/lista", name="pais_lista")
     */
    public function listado()

    {

        $repo = $this-> getDoctrine()->getRepository(Pais::class);
        $paises = $repo->findAll();

        
        return $this->render ('pais/index.html.twig', [
            'paises' => $paises,
        ]);
    }




    /**
     * @Route("/detalle/{id}", name="pais_detalle", requirements={"id"="\d+"})
     */
    public function detalle($id)

    {
        $repo = $this-> getDoctrine()->getRepository(Pais::class);
        $pais= $repo->find($id);
        
        return $this->render ('pais/detalle.html.twig', [
            'pais' => $pais,
        ]);
    }


    /**
     * @Route("/jsonlist", name="pais_jsonlist")
     */
    public function jsonPaises()
    {
        $encoder = new JsonEncoder();
        $normalizer = new ObjectNormalizer();

        $normalizer->setCircularReferenceHandler(
            function ($object) {
                return $object->getId();
            }
        );

        $serializer = new Serializer(array($normalizer), array($encoder));

        $repo = $this->getDoctrine()->getRepository(Pais::class);
        $paises = $repo->findAll();
        $jsonPaises = $serializer->serialize($paises, 'json');        

        $respuesta = new Response($jsonPaises);

        return $respuesta;

    }
}
