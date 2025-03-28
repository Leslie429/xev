<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\SlideRepository;
use App\Repository\AvisRepository;
use App\Entity\Avis;
use App\Entity\Produit;
use App\Entity\Promotion;
use Doctrine\ORM\EntityManagerInterface;

class HomeController extends AbstractController
{
    #[Route(path: "/", name: "home")]
    public function index(SlideRepository $slideRepository, AvisRepository $avisRepository, Request $request, EntityManagerInterface $entityManager): Response
    {
        $slides = $slideRepository->findBy([], ['position' => 'ASC']); // Trier par position
        
        // Récupérer le nom depuis la query string (optionnel)
        $name = $request->query->get("name", "Visiteur");

        // Récupérer les produits en promotion depuis la base de données
        $bestOffers = $entityManager->getRepository(Produit::class)->findBy([], ['prix' => 'ASC'], 4); // Ex: 4 meilleures offres

        // Récupérer les promotions
        $promotions = $entityManager->getRepository(Promotion::class)->findAll();

        // Récupérer les avis clients
        $avisList = $entityManager->getRepository(Avis::class)->findAll();
  
        // Renvoyer les données à la vue
        return $this->render('home/index.html.twig', [
          'slides' => $slides,
          'name' => $name,
          'bestOffers' => $bestOffers,
          'promotions' => $promotions,
          'avisList' => $avisList,
        ]);
    }
}
