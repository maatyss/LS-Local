<?php

namespace App\Controller\Admin;

use App\Entity\MarkerType;
use App\Field\FontAwesomeIconField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class MarkerTypeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return MarkerType::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name')
                ->setFormTypeOptions(['attr' => ['placeholder' => 'nom en minuscule']]),
            TextField::new('color')
                ->setFormTypeOptions(['attr' => ['placeholder' => 'Code hex sans #']]),
            TextField::new('faCode')
                ->setLabel('Code FontAwesome')
                ->setFormTypeOptions(['attr' => ['placeholder' => 'fa-icons']])
                ->hideOnIndex(),
            FontAwesomeIconField::new('faCode', 'Icon')->hideOnForm(),
            ];
    }
}
