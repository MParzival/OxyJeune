<?php

namespace App\Controller;

use App\Repository\RateRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home_app")
     */
    public function index(RateRepository $repository)
    {
        $rates = $repository->findAll();
        return $this->render('home/index.html.twig', [
            'rates' => $rates,
        ]);
    }
}
