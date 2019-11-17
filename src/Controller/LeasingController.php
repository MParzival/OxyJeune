<?php

namespace App\Controller;

use App\Entity\Leasing;
use App\Form\LeasingType;
use App\Repository\LeasingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/leasing")
 */
class LeasingController extends AbstractController
{
    /**
     * @Route("/", name="leasing_index", methods={"GET"})
     */
    public function index(LeasingRepository $leasingRepository): Response
    {
        return $this->render('leasing/index.html.twig', [
            'leasings' => $leasingRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="leasing_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $leasing = new Leasing();
        $form = $this->createForm(LeasingType::class, $leasing);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($leasing);
            $entityManager->flush();

            return $this->redirectToRoute('leasing_index');
        }

        return $this->render('leasing/new.html.twig', [
            'leasing' => $leasing,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="leasing_show", methods={"GET"})
     */
    public function show(Leasing $leasing): Response
    {
        return $this->render('leasing/show.html.twig', [
            'leasing' => $leasing,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="leasing_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Leasing $leasing): Response
    {
        $form = $this->createForm(LeasingType::class, $leasing);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('leasing_index');
        }

        return $this->render('leasing/edit.html.twig', [
            'leasing' => $leasing,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="leasing_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Leasing $leasing): Response
    {
        if ($this->isCsrfTokenValid('delete'.$leasing->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($leasing);
            $entityManager->flush();
        }

        return $this->redirectToRoute('leasing_index');
    }
}
