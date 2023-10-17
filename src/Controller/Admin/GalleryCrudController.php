<?php

namespace App\Controller\Admin;

use App\Entity\Gallery;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class GalleryCrudController extends AbstractCrudController
{
    public const UPLOAD_VEHICLES_BASE_PATH = 'upload/images/vehicles-illustration';
    public const UPLOAD_VEHICLES_DIR = "public/upload/images/vehicles-illustration";

    public static function getEntityFqcn(): string
    {
        return Gallery::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            ImageField::new('image', 'Illustration de galerie')
                ->setBasePath(self::UPLOAD_VEHICLES_BASE_PATH)
                ->setUploadDir(self::UPLOAD_VEHICLES_DIR)
                ->setSortable(false),
            AssociationField::new('vehicle', 'Véhicule associé'),
        ];
    }
}
