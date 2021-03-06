<?php

namespace App\Controller;

use App\Entity\Car;
use App\Entity\Lieu;
use App\Entity\ParkingSpot;
use App\Entity\Reservation;
use App\Form\ReservationSearchType;
use App\Security\Voter\CarVoter;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
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
     * This method is super heavy both on the database and the PHP runtime, use with caution I guess?
     */
    public function newReservationSearchSimple(Request $request): Response
    {
        $form = $this->createForm(ReservationSearchType::class, null, [
            'action' => $this->generateUrl('my_reservations_search_for_new'),
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $search = $request->request->get('reservation_search');

            $voiture = $this->getDoctrine()->getRepository(Car::class)->find($search['voiture']);

            // If the car selected is somehow not the user's car, deny access
            $this->denyAccessUnlessGranted('CAR_OWNER', $voiture);

            $lieu = $this->getDoctrine()->getRepository(Lieu::class)->find($search['lieu']);
            $parkings = $lieu->getParkings();

            $reservations = $this->getDoctrine()->getRepository(Reservation::class)->findAll(); // beurk

            $filteredSpots = [];

            foreach ($parkings as $parking) {
                foreach ($parking->getAvailableSpots() as $spot) {

                    if ($this->validateSpot($spot, $search['date_start'], $search['date_end'])) {
                        array_push($filteredSpots, $spot);
                    }

                }
            }

            return $this->render('reservation/my/searchresult.html.twig', [
                'place' => $lieu,
                'spots' => $filteredSpots,
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

    /**
     * @param ParkingSpot $spot
     * @param $dateStart
     * @param $dateEnd
     * @return boolean
     */
    public function validateSpot(ParkingSpot $spot, $dateStart, $dateEnd) {

        foreach ($spot->getReservations() as $reservation) {

            $searchStart = new Carbon($dateStart);
            $searchEnd = new Carbon($dateEnd);

            $reservationStart = Carbon::instance($reservation->getDateStart());
            $reservationEnd = Carbon::instance($reservation->getDateEnd());

            if ($searchStart->between($reservationStart, $reservationEnd) or $searchEnd->between($reservationStart, $reservationEnd)) {
                return false;
            }

            // Didn't end up using this but leaving it here anyways in case we need it later (idk)
            //$cp = CarbonPeriod::between($reservation->getDateStart(), $reservation->getDateEnd());
        }

        return true;
    }

    /**
     * @Route("/reservation/new/{spot}/{car}/{start}/{end}", name="reservation_save", methods={"GET"})
     */
    public function saveReservation(ParkingSpot $spot, Car $car, $start, $end): Response
    {
        // If the car selected is somehow not the user's car, deny access
        $this->denyAccessUnlessGranted('CAR_OWNER', $car);

        if ($this->validateSpot($spot, $start, $end)) {

            $reservation = new Reservation();
            $reservation->setSpot($spot);
            $reservation->setParking($spot->getParking());
            $reservation->setCar($car);
            $reservation->setUser($this->getUser());

            $startDate = new Carbon($start);
            $endDate = new Carbon($end);

            $reservation->setDateStart($startDate);
            $reservation->setDateEnd($endDate);

            $days = $startDate->diffInDays($endDate)+1;

            $price = $spot->getParking()->getPrice() * $days;

            $reservation->setPrix($price);

            $em = $this->getDoctrine()->getManager();

            $em->persist($reservation);

            $em->flush();

            return $this->redirectToRoute('my_reservations_view', ['id' => $reservation->getId()]);


        } else {

            return $this->render('reservation/my/reservationerror.html.twig', [
               'result' => false
            ]);
        }
    }

}
