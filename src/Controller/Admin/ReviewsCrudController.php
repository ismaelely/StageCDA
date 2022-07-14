<?php

namespace App\Controller\Admin;

use App\Entity\Reviews;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ReviewsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Reviews::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index', 'Avis visiteurs')
            ->setPageTitle('edit', 'Editer le commentaire');

    }


    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('parent', 'Formation')->hideOnForm(),
            TextField::new('firstname', 'Nom'),
            TextField::new('lastname', 'Prenom'),
            EmailField::new('email', 'Email')->OnlyOnForms(),
            TextEditorField::new('avis', 'Avis')->hideOnForm(),
            TextareaField::new('avis', 'Avis')->OnlyOnForms(),
            DateTimeField::new('date', 'Date'),
            BooleanField::new('etat', 'Etat'),
        ];
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->disable(Action::NEW);

    }
}