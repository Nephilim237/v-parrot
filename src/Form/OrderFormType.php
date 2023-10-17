<?php

namespace App\Form;

use App\Entity\Message;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrderFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'form-control rounded-0 w-100',
                    'placeholder' => 'Ex. Thierry Barje',
                ],
            ])
            ->add('email', EmailType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'form-control rounded-0 w-100',
                    'placeholder' => 'Ex. axelpierrot@gmail.com',
                ],
            ])
            ->add('phone', TextType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'form-control rounded-0 w-100',
                    'placeholder' => 'Ex. 00237 6 94 37 25 72',
                ],
            ])
            ->add('subject', TextType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'form-control rounded-0 w-100',
                    'placeholder' => 'Sujet',
                ],
            ])
            ->add('message', TextareaType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'form-control rounded-0 h-200 w-100',
                    'placeholder' => 'Qu\'attendez-vous de nous',
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Message::class,
        ]);
    }
}
