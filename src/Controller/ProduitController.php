<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Service\ImageResizer;
use App\Repository\ProduitRepository;
use App\Repository\CategorieRepository;
use Liip\ImagineBundle\Imagine\Cache\CacheManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

final class ProduitController extends AbstractController
{
    #[Route('/produit/{id}', name: 'produit_show')]
    public function show(Produit $produit): Response
    {
        $imagePath = 'uploads/images/' . $produit->getImgProd();  
        // Rendu de la vue avec le produit et l'URL de l'image filtrée
        return $this->render('produit/show.html.twig', [
            'produit' => $produit,

        ]);
    }

    #[Route('/produits', name: 'produit_index')]
    public function index(Request $request, ProduitRepository $produitRepository, CategorieRepository $categorieRepository): Response
    {
        // Récupérer toutes les catégories
        $categories = $categorieRepository->findAll();
        
        // Récupérer la catégorie sélectionnée (GET ou POST)
        $categorieId = $request->query->get('categorie') ?: $request->request->getInt('categorie');
        if (!ctype_digit($categorieId)) { // Vérifie si c'est bien un nombre
            $categorieId = null; // Valeur par défaut pour éviter l'erreur
        }

        // Vérifier si une catégorie valide est sélectionnée
        if ($categorieId) {
            $produits = $produitRepository->findBy(['categorie' => $categorieId]);
        } else {
            $produits = $produitRepository->findAll();
        }

        // Rendu de la vue avec la liste des produits et catégories
        return $this->render('produit/index.html.twig', [
            'produits' => $produits,
            'categories' => $categories,
            'selectedCategorie' => $categorieId, // Optionnel, utile pour marquer la catégorie active
        ]);
    }
}
