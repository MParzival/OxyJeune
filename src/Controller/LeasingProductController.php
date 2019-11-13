<?php

namespace App\Controller;

use App\Entity\LeasingProduct;
use App\Form\LeasingProductType;
use App\Repository\LeasingProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/leasing/product")
 */
class LeasingProductController extends AbstractController
{
    /**
     * @Route("/", name="leasing_product_index", methods={"GET"})
     */
    public function index(LeasingProductRepository $leasingProductRepository): Response
    {
        return $this->render('leasing_product/index.html.twig', [
            'leasing_products' => $leasingProductRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="leasing_product_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $leasingProduct = new LeasingProduct();
        $form = $this->createForm(LeasingProductType::class, $leasingProduct);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($leasingProduct);
            $entityManager->flush();

            return $this->redirectToRoute('leasing_product_index');
        }

        return $this->render('leasing_product/new.html.twig', [
            'leasing_product' => $leasingProduct,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="leasing_product_show", methods={"GET"})
     */
    public function show(LeasingProduct $leasingProduct): Response
    {
        return $this->render('leasing_product/show.html.twig', [
            'leasing_product' => $leasingProduct,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="leasing_product_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, LeasingProduct $leasingProduct): Response
    {
        $form = $this->createForm(LeasingProductType::class, $leasingProduct);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('leasing_product_index');
        }

        return $this->render('leasing_product/edit.html.twig', [
            'leasing_product' => $leasingProduct,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="leasing_product_delete", methods={"DELETE"})
     */
    public function delete(Request $request, LeasingProduct $leasingProduct): Response
    {
        if ($this->isCsrfTokenValid('delete'.$leasingProduct->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($leasingProduct);
            $entityManager->flush();
        }

        return $this->redirectToRoute('leasing_product_index');
    }
}
