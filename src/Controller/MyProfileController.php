<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class MyProfileController
 * @package App\Controller
 * @Route("/my/profile")
 * @IsGranted("ROLE_USER")
 */
class MyProfileController extends AbstractController
{
    /**
     * @Route("/", name="my_profile")
     */
    public function index()
    {
        return $this->render('my_profile/index.html.twig', [
            'user' => $this->getUser(),
        ]);
    }

    /**
     * @Route("/edit", name="profile_edit")
     */
    public function edit()
    {
        //TODO: implement method stub
    }
}
