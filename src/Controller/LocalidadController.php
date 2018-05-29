<?php

namespace App\Controller;


use Symfony\Component\HttpFoundation\Request;
use App\Entity\Localidad;
use App\Form\LocalidadType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;



/**
* @Route("/localidad")
*/
class LocalidadController extends Controller
{
	
    /**
     * @Route("/nuevo", name="localidad_nuevo")
     */
    public function nuevo()
    {
        $localidad = new localidad();

        $formu = $this->createForm(LocalidadType::class, $localidad);
        $formu->handleRequest($request);

        if ($formu->isSubmitted()) {


            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($localidad);
            $entityManager->flush();
        

            return $this->redirectToRoute('localidad_lista');      
                        
        }

        return $this->render('localidad/index.html.twig', [
            'controller_name' => 'LocalidadController',
        ]);
    }


    /**
     * @Route("/lista", name="localidad_lista")
     */
    public function listado()

    {

        $repo = $this-> getDoctrine()->getRepository(Localidad::class);
        $localidades = $repo->findAll();

        
        return $this->render ('localidad/index.html.twig', [
            'localidades' => $localidades,
        ]);
    }




    /**
     * @Route("/detalle/{id}", name="localidad_detalle", requirements={"id"="\d+"})
     */
    public function detalle($id)

    {
        $repo = $this-> getDoctrine()->getRepository(Localidad::class);
        $localidad= $repo->find($id);
        
        return $this->render ('localidad/detalle.html.twig', [
            'localidad' => $localidad,
        ]);
    }


    /**
     * @Route("/jsonlist", name="localidad_jsonlist")
     */
    public function jsonLocalidades()
    {
        $encoder = new JsonEncoder();
        $normalizer = new ObjectNormalizer();

        $normalizer->setCircularReferenceHandler(
            function ($object) {
                return $object->getId();
            }
        );

        $serializer = new Serializer(array($normalizer), array($encoder));

        $repo = $this->getDoctrine()->getRepository(Localidad::class);
        $localidades = $repo->findAll();
        $jsonLocalidades = $serializer->serialize($localidades, 'json');        

        $respuesta = new Response($jsonLocalidades);

        return $respuesta;

    }
}












