<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use App\Entity\Region;
use App\Form\RegionType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;


/**
* @Route("/region")
*/
class RegionController extends Controller
{
     /**
     * @Route("/nuevo", name="region_nuevo")
     */
    public function nuevo()
    {
        $localidad = new region();

        $formu = $this->createForm(RegionType::class, $region);
        $formu->handleRequest($request);

        if ($formu->isSubmitted()) {


            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($region);
            $entityManager->flush();
        

            return $this->redirectToRoute('region_lista');      
                        
        }

        return $this->render('region/index.html.twig', [
            'controller_name' => 'RegionController',
        ]);
    }


    /**
     * @Route("/lista", name="region_lista")
     */
    public function listado()

    {

        $repo = $this-> getDoctrine()->getRepository(Region::class);
        $regiones = $repo->findAll();

        
        return $this->render ('region/index.html.twig', [
            'regiones' => $regiones,
        ]);
    }




    /**
     * @Route("/detalle/{id}", name="region_detalle", requirements={"id"="\d+"})
     */
    public function detalle($id)

    {
        $repo = $this-> getDoctrine()->getRepository(Region::class);
        $region= $repo->find($id);
        
        return $this->render ('region/detalle.html.twig', [
            'region' => $region,
        ]);
    }


    /**
     * @Route("/jsonlist", name="region_jsonlist")
     */
    public function jsonRegiones()
    {
        $encoder = new JsonEncoder();
        $normalizer = new ObjectNormalizer();

        $normalizer->setCircularReferenceHandler(
            function ($object) {
                return $object->getId();
            }
        );

        $serializer = new Serializer(array($normalizer), array($encoder));

        $repo = $this->getDoctrine()->getRepository(Region::class);
        $regiones = $repo->findAll();
        $jsonRegiones = $serializer->serialize($regiones, 'json');        

        $respuesta = new Response($jsonRegiones);

        return $respuesta;

    }
}
