<?php

namespace App\Controller;

use App\Entity\Lieu;
use App\Entity\Reservation;
use App\Form\ReservationSearchType;
use App\Security\Voter\CarVoter;
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

    /**
     * @Route("/reservation/search", name="my_reservations_search_for_new", methods={"POST"})
     */
    public function newReservationSearchSimple(Request $request): Response
    {
        $form = $this->createForm(ReservationSearchType::class, null, [
            'action' => $this->generateUrl('my_reservations_search_for_new'),
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $search = $request->request->get('reservation_search');

            $voiture = $this->getDoctrine()->getRepository(Voiture::class)->find($search['voiture']);

            // If the car selected is somehow not the user's car, deny access
            $this->denyAccessUnlessGranted('CAR_OWNER', $voiture);

            $lieu = $this->getDoctrine()->getRepository(Lieu::class)->find($search['lieu']);
            $lieu->getAvailableSpots();

            $reservations = $this->getDoctrine()->getRepository(Reservation::class)->findAll(); // beurk

            return $this->render('reservation/my/searchresult.html.twig', [
                'spots' => $lieu->getAvailableSpots(),
                'date_start' => $search['date_start'],
                'date_end' => $search['date_end'],
                'voiture' => $search['voiture'],
                'reservations' => $reservations,
            ]);


        } else {
            return $this->render('home/index.html.twig', [
                'controller_name' => 'HomeController',
                'form' => $form->createView()
            ]);
        }
    }
}
