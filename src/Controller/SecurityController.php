<?php

namespace App\Controller;

use App\Form\LoginFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

final class SecurityController extends AbstractController
{
    #[Route('login', name: 'login')]
    public function login(Request $request, AuthenticationUtils $authenticationUtils): Response
    {
        // Vérifie que la méthode de la requête est POST
        if ($request->isMethod('POST')) {
            // Affiche les paramètres POST pour déboguer
            dd($request->request->all());
        }
        // Vérification si l'utilisateur est déjà authentifié
        if ($this->getUser()) {
            // Si l'utilisateur est déjà connecté, redirige-le vers la page d'accueil
            return $this->redirectToRoute('/');
        }

        // Récupérer les erreurs d'authentification (s'il y en a)
        $error = $authenticationUtils->getLastAuthenticationError();
        if ($error) {
            dump($error); // Débogue l'erreur pour voir ce qu'il se passe
        }
        
        // Dernier email saisi (utile pour ne pas le retaper en cas d'erreur)
        $lastUsername = $authenticationUtils->getLastUsername();
       
        // Création du formulaire de connexion
        $form = $this->createForm(LoginFormType::class, [
            'email' => $lastUsername,
        ]);

        // Traitement du formulaire lors de la soumission
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            dump($data); // Ajoute ceci pour voir ce qui est envoyé
            $email = $data['email']; // Vérifie que l'email est bien là
            // Affiche les erreurs pour chaque champ
            foreach ($form->getErrors(true) as $error) {
                echo $error->getMessage();
            }
        }
        
        
        return $this->render('security/login.html.twig', [
            'form' => $form->createView(),
            'error' => $error
        ]);
    }

    #[Route('/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('Cette méthode peut être vide - elle est interceptée par le pare-feu de sécurité.');
    }
}
