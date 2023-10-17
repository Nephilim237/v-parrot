<?php

namespace App\Form;

use App\Entity\VehicleType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchVehicleFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->setMethod('get')
            ->add('brand', TextType::class, [
                'label' => 'Renseigner Une Marque Ou Un Model',
                'label_attr' => [
                    'class' => 'form-label mb-1 fw-500 barlow',
                ],
                'attr' => [
                    'class' => 'form-control rounded-0',
                    'placeholder' => 'Ex. Citroen',
                ],
                'required' => false,
            ])
            ->add('type', EntityType::class, [
                'class' => VehicleType::class,
                'choice_label' => 'type',
                'label' => 'Choisir Un Type De Moteur',
                'label_attr' => [
                    'class' => 'form-label mb-1 fw-500 barlow',
                ],
                'attr' => [
                    'class' => 'form-select rounded-0',
                    'placeholder' => 'Choisir Un Type De Moteur'
                ],
                'required' => false,
            ])
            ->add('price', RangeType::class, [
                'attr' => [
                    'class' => 'form-range',
                    'min' => 0,
                    'max' => 100000,
                    'step' => 50,
                ],
                'label' => 'Fourchette De Prix',
                'label_attr' => [
                    'class' => 'form-label mb-1 fw-500 barlow',
                ],
                'required' => false,
            ])
            ->add('milliage', RangeType::class, [
                'attr' => [
                    'class' => 'form-range',
                    'min' => 0,
                    'max' => 500000,
                    'step' => 1000,
                ],
                'label' => 'Kilométrage',
                'label_attr' => [
                    'class' => 'form-label mb-1 fw-500 barlow',
                ],
                'required' => false,
            ])
            ->add('year', RangeType::class, [
                'attr' => [
                    'class' => 'form-range',
                    'min' => 2000,
                    'max' => 2023,
                    'step' => 1,
                ],
                'label' => 'Année',
                'label_attr' => [
                    'class' => 'form-label mb-1 fw-500 barlow',
                ],
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
