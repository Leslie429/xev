<?php

namespace App\Controller\Admin;

use App\Entity\Promotion;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField; // pour lier un produit à la promotion
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;

class PromotionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Promotion::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            // Le champ pour lier un produit à cette promotion
            AssociationField::new('produit') // Associe la promotion avec un produit
                ->setFormTypeOption('choice_label', 'nom') // Affiche le nom du produit dans la liste déroulante
                ->setRequired(true), // Rendre ce champ obligatoire
            TextField::new('description', 'Description'),
            ImageField::new('image', 'Image')
                ->setBasePath('uploads/images')
                ->setUploadDir('public/uploads/images')
                ->setRequired(false),
            IntegerField::new('pourc_reduc', 'Réduction (%)')
                ->setHelp('Indiquez le pourcentage de réduction, ex: 10 pour 10%'),
            DateTimeField::new('date_deb', 'Date de début')
                ->setFormat('short', 'short'),
            DateTimeField::new('date_fin', 'Date de fin')
                ->setFormat('short', 'short'),
        ];
    }
}

