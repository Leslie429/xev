<?php

namespace App\Controller;

use App\Entity\Promotion;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\PromotionRepository;
use Symfony\Component\Routing\Attribute\Route;

final class PromotionController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/promotions', name: 'promotions')]
    public function index(): Response
    {
        // Récupère les promotions actives
        $promotions = $this->entityManager
            ->getRepository(Promotion::class)
            ->findAll();
        // Affiche la page avec les promotions
        return $this->render('promotion/index.html.twig', [
            'promotions' => $promotions,
        ]);
    }
}
