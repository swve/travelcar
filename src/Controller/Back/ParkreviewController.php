<?php

namespace App\Controller\Back;

use App\Entity\Parkreview;
use App\Form\ParkreviewType;
use App\Repository\ParkreviewRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/parkreview")
 */
class ParkreviewController extends AbstractController
{
    /**
     * @Route("/", name="parkreview_index", methods={"GET"})
     */
    public function index(ParkreviewRepository $parkreviewRepository): Response
    {
        return $this->render('parkreview/index.html.twig', [
            'parkreviews' => $parkreviewRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="parkreview_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $parkreview = new Parkreview();
        $form = $this->createForm(ParkreviewType::class, $parkreview);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($parkreview);
            $entityManager->flush();

            return $this->redirectToRoute('parkreview_index');
        }

        return $this->render('parkreview/new.html.twig', [
            'parkreview' => $parkreview,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="parkreview_show", methods={"GET"})
     */
    public function show(Parkreview $parkreview): Response
    {
        return $this->render('parkreview/show.html.twig', [
            'parkreview' => $parkreview,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="parkreview_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Parkreview $parkreview): Response
    {
        $form = $this->createForm(ParkreviewType::class, $parkreview);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('parkreview_index', [
                'id' => $parkreview->getId(),
            ]);
        }

        return $this->render('parkreview/edit.html.twig', [
            'parkreview' => $parkreview,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="parkreview_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Parkreview $parkreview): Response
    {
        if ($this->isCsrfTokenValid('delete'.$parkreview->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($parkreview);
            $entityManager->flush();
        }

        return $this->redirectToRoute('parkreview_index');
    }
}
