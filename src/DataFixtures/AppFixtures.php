<?php

namespace App\DataFixtures;

use App\Entity\Joueurs;
use App\Repository\JoueursRepository;
use App\Entity\Cartes;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $joueur = new Joueurs();
        $joueur->setNom("Didier");
        $joueur->setEmail("didier@didier.com");
        $joueur->setScore(153);
        $manager->persist($joueur);

        $joueur = new Joueurs();
        $joueur->setNom("Georges");
        $joueur->setEmail("georges@georges.com");
        $joueur->setScore(2);
        $manager->persist($joueur);

        $joueur = new Joueurs();
        $joueur->setNom("Martine");
        $joueur->setEmail("martine@martine.com");
        $joueur->setScore(26);
        $manager->persist($joueur);

        $carte = new Cartes();
        $carte->setNom('Carte1');
        $carte->setIdJoueur(1);
        $manager->persist($carte);

        $manager->flush();
    }
}
