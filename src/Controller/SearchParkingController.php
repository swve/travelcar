<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SearchParkingController extends AbstractController
{
    /**
     * @Route("/search/parking", name="search_parking")
     */
    public function index()
    {
        return $this->render('search_parking/index.html.twig', [
            'controller_name' => 'SearchParkingController',
        ]);
    }
}
