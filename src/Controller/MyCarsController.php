<?php

namespace App\Controller;

use App\Entity\Car;
use App\Form\MyCarType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class MyCarsController
 * @package App\Controller
 * @Route("/my/cars")
 */
class MyCarsController extends AbstractController
{
    /**
     * @Route("/", name="my_cars_index", methods={"GET"})
     */
    public function index(): Response
    {
        return $this->render('my_cars/index.html.twig', [
            'cars' => $this->getUser()->getCars(),
        ]);
    }

    /**
     * @Route("/new", name="my_cars_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $car = new Car();
        $form = $this->createForm(MyCarType::class, $car);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $car->setUser($this->getUser());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($car);
            $entityManager->flush();

            return $this->redirectToRoute('my_cars_index');
        }

        return $this->render('my_cars/new.html.twig', [
            'car' => $car,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="my_cars_show", methods={"GET"})
     */
    public function show(Car $car): Response
    {
        return $this->render('my_cars/show.html.twig', [
            'car' => $car,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="my_cars_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Car $car): Response
    {
        $form = $this->createForm(MyCarType::class, $car);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('my_cars_index', [
                'id' => $car->getId(),
            ]);
        }

        return $this->render('my_cars/edit.html.twig', [
            'car' => $car,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="my_cars_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Car $car): Response
    {
        if ($this->isCsrfTokenValid('delete'.$car->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($car);
            $entityManager->flush();
        }

        return $this->redirectToRoute('my_cars_index');
    }
}
