<?php

namespace App\Controller\Back;

use App\Entity\AvailableSpot;
use App\Form\AvailableSpotType;
use App\Repository\AvailableSpotRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("back/available_spots")
 */
class AvailableSpotController extends AbstractController
{
    /**
     * @Route("/", name="available_spot_index", methods={"GET"})
     */
    public function index(AvailableSpotRepository $availableSpotRepository): Response
    {
        return $this->render('available_spot/index.html.twig', [
            'available_spots' => $availableSpotRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="available_spot_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $availableSpot = new AvailableSpot();
        $form = $this->createForm(AvailableSpotType::class, $availableSpot);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($availableSpot);
            $entityManager->flush();

            return $this->redirectToRoute('available_spot_index');
        }

        return $this->render('available_spot/new.html.twig', [
            'available_spot' => $availableSpot,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="available_spot_show", methods={"GET"})
     */
    public function show(AvailableSpot $availableSpot): Response
    {
        return $this->render('available_spot/show.html.twig', [
            'available_spot' => $availableSpot,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="available_spot_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, AvailableSpot $availableSpot): Response
    {
        $form = $this->createForm(AvailableSpotType::class, $availableSpot);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('available_spot_index', [
                'id' => $availableSpot->getId(),
            ]);
        }

        return $this->render('available_spot/edit.html.twig', [
            'available_spot' => $availableSpot,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="available_spot_delete", methods={"DELETE"})
     */
    public function delete(Request $request, AvailableSpot $availableSpot): Response
    {
        if ($this->isCsrfTokenValid('delete'.$availableSpot->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($availableSpot);
            $entityManager->flush();
        }

        return $this->redirectToRoute('available_spot_index');
    }
}
