<?php

namespace App\Controller\Admin;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserCrudController extends AbstractCrudController
{
    public function __construct(private readonly UserPasswordHasherInterface $hasher)
    {
    }

    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index', 'Liste des Employés')
            ->setTimezone('Africa/Douala')
            ;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->setPermission(Action::NEW, 'ROLE_ADMIN')
            ->setPermission(Action::EDIT, 'ROLE_ADMIN')
            ->setPermission(Action::DELETE, 'ROLE_ADMIN')
            ->update(Crud::PAGE_INDEX, Action::NEW, function(Action $action) {
                return $action
                    ->setLabel('Ajouter Nouvel Employé')
                    ->setIcon('fas fa-user-plus')
                    ->setCssClass('text-capitalize');
            })
            ->update(Crud::PAGE_INDEX, Action::EDIT, function (Action $action) {
                return $action
                    ->setLabel('Modifier Un Employé')
                    ->setIcon('fas fa-user-edit')
                    ->setCssClass('text-capitalize');
            })
            ->update(Crud::PAGE_INDEX, Action::DELETE, function (Action $action) {
                return $action->setLabel("Supprimer Un Employé")
                    ->setIcon('fas fa-user-slash')
                    ->setCssClass('text-capitalize');
            })
            ;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('fullname', "Nom Complet"),
            EmailField::new('email', "Adresse e-mail"),
            TextField::new('password', "Mot de passe")->hideOnIndex()->hideOnForm()->hideOnDetail(),
            DateTimeField::new('createdAt', 'Ajouté le')->hideOnForm()
        ];
    }


    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if (!$entityInstance instanceof User) return;
        $password = $this->hasher->hashPassword($entityInstance, "1234567890");
        $entityInstance->setPassword($password);
        parent::persistEntity($entityManager, $entityInstance);
    }
}
