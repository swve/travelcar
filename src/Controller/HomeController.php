<?php

namespace App\Controller;

use App\Entity\Lieu;
use App\Form\ReservationSearchType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        $form = $this->createForm(ReservationSearchType::class, null, [
            'action' => $this->generateUrl('my_reservations_search_for_new'),
        ]);

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'form' => $form->createView()
        ]);
    }
}
