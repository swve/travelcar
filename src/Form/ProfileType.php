<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class, [
                'required' => true,
                'label' => 'First Name'
            ])
            ->add('lastname', TextType::class, [
                'required' => true,
                'label' => 'Last Name'
            ])
            ->add('email', EmailType::class, [
                'required' => true,
                'label' => 'Email Address'
            ])
            ->add('img')
            ->add('bio', TextareaType::class, [
                'required' => false,
                'label' => 'Describe yourself in a few sentences'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
