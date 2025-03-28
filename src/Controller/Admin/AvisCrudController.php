<?php

namespace App\Controller\Admin;

use App\Entity\Avis;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class AvisCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Avis::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            // Champ Note (de 1 à 5 étoiles)
            ChoiceField::new('note', 'Note')
                ->setChoices([
                    '⭐' => 1,
                    '⭐⭐' => 2,
                    '⭐⭐⭐' => 3,
                    '⭐⭐⭐⭐' => 4,
                    '⭐⭐⭐⭐⭐' => 5,
                ])
                ->renderAsNativeWidget()
                ->hideOnIndex(), // Masqué sur la liste, car on va utiliser le champ personnalisé

            // Affichage des étoiles dans la liste des avis
            IntegerField::new('note','Note')
            ->formatValue(function ($value) {
                $stars = str_repeat('⭐', $value); // Crée une chaîne de caractères avec les étoiles
                return $stars; // Retourne les étoiles à afficher
            })
            ->onlyOnIndex(), // Affichage sur la liste des avis uniquement


            // Champ Appréciation en texte
            TextField::new('appreciation', 'Appréciation'),
        ];
    }
}
