<?php

namespace App\Controller\Admin;

use App\Entity\Produit;
use App\Entity\Categorie;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;



class ProduitCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Produit::class;
    }

    public function configureFields(string $pageName): iterable
    {
        // Les champs générés automatiquement par EasyAdmin pour le CRUD
        $fields = [
            TextField::new('nom'),
            TextField::new('desription'),
            MoneyField::new('prix')->setCurrency('EUR'), // Exemples de champs générés automatiquement pour l'entité Produit
            IntegerField::new('stock'),            // ... ajouter d'autres champs générés automatiquement si nécessaire
        ];

        // Ajouter le champ de catégorie sans remplacer les autres champs
        $fields[] = AssociationField::new('categorie')
            ->setFormTypeOption('choice_label', 'nom') // Remplacer 'nom' par le champ approprié dans Categorie
            ->setFormTypeOption('by_reference', false); // Permet de lier ou de créer une nouvelle catégorie 

        // Ajouter un champ pour l'image du produit
        
        $fields[] = ImageField::new('img_prod')
            ->setBasePath('uploads/images') // Spécifie le chemin où les images seront stockées
            ->setUploadDir('public/uploads/images') // Spécifie le dossier d'upload des images
            ->setRequired(false);

        // Ajouter un champ pour la marque
        $fields[] = TextField::new('marque');

        $fields[] = DateTimeField::new('created_at')
            ->setFormat('short', 'short')
            ->setFormTypeOption('disabled', true); // Rend le champ non modifiable

        return $fields;
    }
}
