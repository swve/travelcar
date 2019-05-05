<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MyProfileController extends AbstractController
{
    /**
     * @Route("/my/profile", name="my_profile")
     */
    public function index()
    {
        return $this->render('my_profile/index.html.twig', [
            'controller_name' => 'MyProfileController',
        ]);
    }
}
