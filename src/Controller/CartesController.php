<?php

namespace App\Controller;

use App\Entity\Joueurs;
use App\Repository\JoueursRepository;

use App\Entity\Cartes;
use App\Repository\CartesRepository;

use App\Form\CartesType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartesController extends AbstractController
{
    /**
     * @Route("/cartes", name="cartes")
     */
    public function index(CartesRepository $cartesRepository)
    {
    	$cartes = $cartesRepository->findAll();

        return $this->render('cartes/index.html.twig', [
            'cartes' => $cartesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/cartes/new", name="new_cartes")
     */
    public function new()
    {
    	//Form pour affecter une carte à un joueur s'il en a pas
        return $this->render('cartes/new.html.twig', [
            'cartes' => $cartesRepository->findAll(),
        ]);
    }

}
