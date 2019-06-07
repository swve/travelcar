<?php

namespace App\Controller;

use App\Form\ProfileType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
     * @Route("/edit", name="profile_edit", methods={"GET","POST"})
     */
    public function edit(Request $request)
    {
        $form = $this->createForm(ProfileType::class, $this->getUser());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('my_profile');
        }

        return $this->render('my_profile/edit.html.twig', [
            'user' => $this->getUser(),
            'form' => $form->createView()
        ]);
    }
}
