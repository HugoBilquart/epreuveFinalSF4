<?php

namespace App\Controller;

use App\Entity\Joueurs;
use App\Form\Joueurs1Type;
use App\Repository\JoueursRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class JoueursController extends AbstractController
{
    /**
     * @Route("/", name="joueurs_index", methods={"GET"})
     */
    public function index(JoueursRepository $joueursRepository): Response
    {
        return $this->render('joueurs/index.html.twig', [
            'joueurs' => $joueursRepository->findAllOrderByScoreDesc(),
        ]);
    }

    /**
     * @Route("/joueurs/"), name="joueurs"
     */
    public function joueurs(): Response
    {
        return $this->redirectToRoute('joueurs_index');
    }

    /**
     * @Route("/new", name="joueurs_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $joueur = new Joueurs();
        $form = $this->createForm(Joueurs1Type::class, $joueur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($joueur);
            $entityManager->flush();

            return $this->redirectToRoute('joueurs_index');
        }

        return $this->render('joueurs/new.html.twig', [
            'joueur' => $joueur,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="joueurs_show", methods={"GET"})
     */
    public function show(Joueurs $joueur): Response
    {
        return $this->render('joueurs/show.html.twig', [
            'joueur' => $joueur,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="joueurs_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Joueurs $joueur): Response
    {
        $form = $this->createForm(Joueurs1Type::class, $joueur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('joueurs_index');
        }

        return $this->render('joueurs/edit.html.twig', [
            'joueur' => $joueur,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="joueurs_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Joueurs $joueur): Response
    {
        if ($this->isCsrfTokenValid('delete'.$joueur->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($joueur);
            $entityManager->flush();
        }

        return $this->redirectToRoute('joueurs_index');
    }
}
