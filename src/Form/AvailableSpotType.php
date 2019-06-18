<?php

namespace App\Form;

use App\Entity\ParkingSpot;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AvailableSpotType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('code')
            ->add('date_start')
            ->add('date_end')
            ->add('parking')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ParkingSpot::class,
            'attr' => [
                'class' => 'selectpicker'
            ]
        ]);
    }
}
