<?php

namespace App\Controller\Admin;

use App\Entity\Raid;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class RaidCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Raid::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            TextField::new('user.pseudo', 'Pseudo'),
            TextField::new('userCharacter.name', 'Personnage'),
            BooleanField::new('dayOne', 'Jour 1'),
            BooleanField::new('dayTwo', 'Jour 2'),
            BooleanField::new('dayThree', 'Jour 3'),
        ];
    }
}
