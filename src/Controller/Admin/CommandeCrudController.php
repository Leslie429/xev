<?php

namespace App\Controller\Admin;

use App\Entity\Commande;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;

class CommandeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Commande::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        $fields = [
            MoneyField::new('prix')->setCurrency('EUR'), // Exemples de champs générés automatiquement pour l'entité Produit
            TextField::new('adr_livr'),
        ];
        $fields[] = DateTimeField::new('created_at')
            ->setFormat('short', 'short')
            ->setFormTypeOption('disabled', true); // Rend le champ non modifiable

            $fields[] = ChoiceField::new('statut_com')
            ->setChoices([
                'En attente' => 'en_attente',
                'Livré' => 'livre',
                'Annulé' => 'annule',
            ]);
        
        return $fields;
    }
}
