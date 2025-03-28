<?php
// src/Controller/RegistrationController.php
namespace App\Controller;

use App\Form\RegistrationFormType;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;


class RegistrationController extends AbstractController
{
    #[Route('/registration', name: 'registration')]
    public function register(Request $request,  EntityManagerInterface $entityManager): Response
    {

        // Vérification rapide de l'injection
        // var_dump($passwordHasher); // Devrait afficher l'objet lié à security.password_hasher
        $user = new User();

        // Exemple : si l'utilisateur est un client
        $user->setRoles(['ROLE_USER']); // ou ['ROLE_ADMIN'] pour un admin

        $form = $this->createForm(RegistrationFormType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPassword($form->get('password')->getData());

            /* Encode le mot de passe avant de l'enregistrer
            $hashedPassword = $passwordHasher->hash($form->get('password')->getData());
            $user->setPassword($hashedPassword);*/

            // Sauvegarder l'utilisateur dans la base de données
            $entityManager->persist($user);
            $entityManager->flush();

            // Rediriger l'utilisateur après inscription
            return $this->redirectToRoute('login'); // Changez 'app_home' selon votre route d'accueil

            
        }

        return $this->render('registration/index.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
