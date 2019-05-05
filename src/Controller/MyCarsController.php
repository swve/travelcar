<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MyCarsController extends AbstractController
{
    /**
     * @Route("/my/cars", name="my_cars")
     */
    public function index()
    {
        return $this->render('my_cars/index.html.twig', [
            'controller_name' => 'MyCarsController',
        ]);
    }
}
