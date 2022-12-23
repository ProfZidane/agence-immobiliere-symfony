<?php

namespace App\Form;

use App\Entity\Objects;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ObjectsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('location')
            ->add('title')
            ->add('price')
            ->add('description')
            ->add('type')
            ->add('owner')
            ->add('main_img')
            ->add('img_1')
            ->add('img_2')
            ->add('img_3')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Objects::class,
        ]);
    }
}
