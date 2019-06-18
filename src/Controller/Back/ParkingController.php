<?php

namespace App\Controller\Back;

use App\Entity\Parking;
use App\Entity\ParkingSpot;
use App\Form\ParkingType;
use App\Repository\ParkingRepository;
use Carbon\Carbon;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/back/parking")
 */
class ParkingController extends AbstractController
{
    /**
     * @Route("/", name="parking_index", methods={"GET"})
     */
    public function index(ParkingRepository $parkingRepository): Response
    {
        return $this->render('parking/index.html.twig', [
            'parkings' => $parkingRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="parking_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $parking = new Parking();
        $form = $this->createForm(ParkingType::class, $parking);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            for ($k = 0 ; $k < $request->request->get('parking')['capacity']; $k++) {
                $newSpot = new ParkingSpot();
                $newSpot->setParking($parking);
                $newSpot->setCode($parking->getTitle().'_'.$k);
                $newSpot->setDateStart(Carbon::now());
                $newSpot->setDateEnd(Carbon::maxValue());
                $entityManager->persist($newSpot);
            }
            $entityManager->persist($parking);
            $entityManager->flush();

            return $this->redirectToRoute('parking_index');
        }

        return $this->render('parking/new.html.twig', [
            'parking' => $parking,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="parking_show", methods={"GET"})
     */
    public function show(Parking $parking): Response
    {
        return $this->render('parking/show.html.twig', [
            'parking' => $parking,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="parking_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Parking $parking): Response
    {
        $form = $this->createForm(ParkingType::class, $parking);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('parking_index', [
                'id' => $parking->getId(),
            ]);
        }

        return $this->render('parking/edit.html.twig', [
            'parking' => $parking,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="parking_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Parking $parking): Response
    {
        if ($this->isCsrfTokenValid('delete'.$parking->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($parking);
            $entityManager->flush();
        }

        return $this->redirectToRoute('parking_index');
    }
}
