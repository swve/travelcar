<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SearchCarsController extends AbstractController
{
    /**
     * @Route("/search/cars", name="search_cars")
     */
    public function index()
    {
        return $this->render('search_cars/index.html.twig', [
            'controller_name' => 'SearchCarsController',
        ]);
    }
}
