<?php

namespace App\Controller\Back;

use App\Repository\ParkingRepository;
use App\Repository\ParkreviewRepository;
use App\Repository\ReservationRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BackController extends AbstractController
{
    /**
     * @Route("/back", name="back")
     */
    public function index(ReservationRepository $reservationRepository , ParkingRepository $parkingRepository , ParkreviewRepository $parkreviewRepository)
    {
        return $this->render('back/index.html.twig', [
            'controller_name' => 'BackController',
            'reservations' => $reservationRepository->findAll(),
            'parkreviews' => $parkreviewRepository->findAll(),
            
        ]);
    }
}
