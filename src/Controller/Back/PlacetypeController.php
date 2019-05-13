<?php

namespace App\Controller\Back;

use App\Entity\Placetype;
use App\Form\PlacetypeType;
use App\Repository\PlacetypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/back/placetype")
 */
class PlacetypeController extends AbstractController
{
    /**
     * @Route("/", name="placetype_index", methods={"GET"})
     */
    public function index(PlacetypeRepository $placetypeRepository): Response
    {
        return $this->render('placetype/index.html.twig', [
            'placetypes' => $placetypeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="placetype_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $placetype = new Placetype();
        $form = $this->createForm(PlacetypeType::class, $placetype);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($placetype);
            $entityManager->flush();

            return $this->redirectToRoute('placetype_index');
        }

        return $this->render('placetype/new.html.twig', [
            'placetype' => $placetype,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="placetype_show", methods={"GET"})
     */
    public function show(Placetype $placetype): Response
    {
        return $this->render('placetype/show.html.twig', [
            'placetype' => $placetype,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="placetype_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Placetype $placetype): Response
    {
        $form = $this->createForm(PlacetypeType::class, $placetype);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('placetype_index', [
                'id' => $placetype->getId(),
            ]);
        }

        return $this->render('placetype/edit.html.twig', [
            'placetype' => $placetype,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="placetype_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Placetype $placetype): Response
    {
        if ($this->isCsrfTokenValid('delete'.$placetype->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($placetype);
            $entityManager->flush();
        }

        return $this->redirectToRoute('placetype_index');
    }
}
