<?php

namespace App\Controller\Back;

use App\Entity\Car;
use App\Form\CarsType;
use App\Repository\CarRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/back/cars")
 */
class CarsController extends AbstractController
{
    /**
     * @Route("/", name="cars_index", methods={"GET"})
     */
    public function index(CarRepository $carRepository): Response
    {
        return $this->render('cars/index.html.twig', [
            'cars' => $carRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="cars_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $car = new Car();
        $form = $this->createForm(CarsType::class, $car);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($car);
            $entityManager->flush();

            return $this->redirectToRoute('cars_index');
        }

        return $this->render('cars/new.html.twig', [
            'car' => $car,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="cars_show", methods={"GET"})
     */
    public function show(Car $car): Response
    {
        return $this->render('cars/show.html.twig', [
            'car' => $car,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="cars_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Car $car): Response
    {
        $form = $this->createForm(CarsType::class, $car);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('cars_index', [
                'id' => $car->getId(),
            ]);
        }

        return $this->render('cars/edit.html.twig', [
            'car' => $car,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="cars_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Car $car): Response
    {
        if ($this->isCsrfTokenValid('delete'.$car->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($car);
            $entityManager->flush();
        }

        return $this->redirectToRoute('cars_index');
    }
}
