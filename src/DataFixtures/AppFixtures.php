<?php

namespace App\DataFixtures;

use App\Entity\Produit;
use App\Entity\Slide;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $existingSlides = $manager->getRepository(Slide::class)->findAll();

        if (count($existingSlides) === 0) { // Ajoute uniquement si la table est vide

            $slidesData = [
                ['image' => 'uploads/images/slide1.jpeg', 'text' => 'Premier slide', 'position' => 1],
                ['image' => 'uploads/images/slide2.jpeg', 'text' => 'Deuxième slide', 'position' => 2],
                ['image' => 'uploads/images/slide3.jpeg', 'text' => 'Troisième slide', 'position' => 3],
            ];

            foreach ($slidesData as $data) {
                $slide = new Slide();
                $slide->setImage($data['image']);
                $slide->setText($data['text']);
                $slide->setPosition($data['position']);
                $manager->persist($slide);
            }

            $manager->flush();
        }
    
    }
}
