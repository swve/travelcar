<?php

namespace App\Form;

use App\Entity\ParkingSpot;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReservationSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lieu', EntityType::class, [
                'class' => 'App\Entity\Lieu',
                'required' => true,
            ])
            ->add('date_start', DateType::class, [
                'label' => 'Date de début',
                'required' => true,
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
            ])
            ->add('date_end', DateType::class, [
                'label' => 'Date de fin',
                'required' => true,
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
            ])
            ->add('voiture', EntityType::class, [
                'class' => 'App\Entity\Car',
                'label' => 'Pour la Voiture :',
                'required' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
        ]);
    }
}
