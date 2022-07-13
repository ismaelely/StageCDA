<?php

namespace App\Controller\Admin;

use App\Entity\CommentsActu;
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

class CommentsActuCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return CommentsActu::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index', 'Commentaires Actualites')
            ->setPageTitle('edit', 'Editer le commentaire')
            ;

    }


    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('actu')->hideOnForm(),
            TextField::new('nom'),
            TextField::new('prenom'),
            EmailField::new('email')->OnlyOnForms(),
            TextEditorField::new('avis')->hideOnForm(),
            TextareaField::new('avis')->OnlyOnForms(),
            DateTimeField::new('date'),
            BooleanField::new('etat'),
        ];
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->disable(Action::NEW)
            ;


    }
}