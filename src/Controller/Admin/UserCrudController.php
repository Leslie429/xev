<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureCrud(Crud $crud): Crud{
        return $crud
            ->setEntityLabelInSingular("Utilisateur")
            ->setEntityLabelInPlural("Utilisateurs")
            ->setPaginatorPageSize(10)
            ->setPaginatorRangeSize(4)
        ;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('nom')->setRequired(true),
            TextField::new('prenom')->setRequired(true),
            TextField::new('num_tel')->setRequired(true)->setLabel('Numéro de téléphone'),
            TextField::new('email')->setRequired(true),
            TextField::new('password')->hideOnIndex(), 
            DateTimeField::new('created_at')
                ->setLabel('Date de création')
                ->setFormat('dd/MM/yyyy HH:mm')->hideOnForm(),// Format plus lisible
                //->hideOnForm(), // Masqué lors de la création/édition (car généré automatiquement)
        ];
    }
}
