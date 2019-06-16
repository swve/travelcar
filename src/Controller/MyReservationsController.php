<?php

namespace App\Controller;

use App\Entity\Reservation;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class MyReservationsController
 * @package App\Controller
 */
class MyReservationsController extends AbstractController
{
    /**
     * @Route("/my/reservations", name="my_reservations_index")
     */
    public function index()
    {
        return $this->render('reservation/my/index.html.twig', [
            'reservations' => $this->getUser()->getReservations(),
        ]);
    }

    /**
     * @Route("/my/reservations/{id}", name="my_reservations_view")
     */
    public function view(Reservation $reservation)
    {
        $this->denyAccessUnlessGranted('RESERVATION_OWNER', $reservation);

        return $this->render('reservation/my/show.html.twig', [
            'reservation' => $reservation
        ]);
    }

    /**
     * @Route("/{id}", name="my_reservations_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Reservation $reservation): Response
    {
        $this->denyAccessUnlessGranted('RESERVATION_OWNER', $reservation);

        if ($this->isCsrfTokenValid('delete'.$reservation->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($reservation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('my_reservations_index');
    }
}
