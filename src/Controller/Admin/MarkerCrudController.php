<?php

namespace App\Controller\Admin;

use App\Entity\Marker;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class MarkerCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Marker::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name'),
            TextField::new('title'),
            TextareaField::new('comment'),
            AssociationField::new('creator')
                ->formatValue(function ($value, $entity) {
                    return $entity->getCreator()->getName();
                })->hideOnForm(),
            ImageField::new('image')->hideOnForm(),
            TextareaField::new('region')->hideOnForm(),
            TextareaField::new('posX')->hideOnForm(),
            TextareaField::new('posY')->hideOnForm(),
        ];
    }

}
