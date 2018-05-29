<?php

namespace App\Controller;

use App\Entity\Monumento;
use App\Form\MonumentoType;
use App\Repository\MonumentoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/monumento")
 */
class MonumentoController extends Controller
{
    /**
     * @Route("/", name="monumento_index", methods="GET")
     */
    public function index(MonumentoRepository $monumentoRepository): Response
    {
        return $this->render('monumento/index.html.twig', ['monumentos' => $monumentoRepository->findAll()]);
    }

    /**
     * @Route("/new", name="monumento_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $monumento = new Monumento();
        $form = $this->createForm(MonumentoType::class, $monumento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($monumento);
            $em->flush();

            return $this->redirectToRoute('monumento_index');
        }

        return $this->render('monumento/new.html.twig', [
            'monumento' => $monumento,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="monumento_show", methods="GET")
     */
    public function show(Monumento $monumento): Response
    {
        return $this->render('monumento/show.html.twig', ['monumento' => $monumento]);
    }

    /**
     * @Route("/{id}/edit", name="monumento_edit", methods="GET|POST")
     */
    public function edit(Request $request, Monumento $monumento): Response
    {
        $form = $this->createForm(MonumentoType::class, $monumento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('monumento_edit', ['id' => $monumento->getId()]);
        }

        return $this->render('monumento/edit.html.twig', [
            'monumento' => $monumento,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="monumento_delete", methods="DELETE")
     */
    public function delete(Request $request, Monumento $monumento): Response
    {
        if ($this->isCsrfTokenValid('delete'.$monumento->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($monumento);
            $em->flush();
        }

        return $this->redirectToRoute('monumento_index');
    }
}
