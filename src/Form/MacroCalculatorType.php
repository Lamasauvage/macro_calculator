<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MacroCalculatorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('weight', NumberType::class, [
                'label' => 'Poids (kg)', // Weight (kg)
            ])
            ->add('height', NumberType::class, [
                'label' => 'Taille (cm)', // Height (cm)
            ])
            ->add('age', NumberType::class, [
                'label' => 'Âge', // Age
            ])
            ->add('gender', ChoiceType::class, [
                'label' => 'Sexe', // Gender
                'choices' => [
                    'Homme' => 'homme', // Male
                    'Femme' => 'femme', // Female
                ],
            ])
            ->add('activityLevel', ChoiceType::class, [
                'label' => 'Niveau d\'activité', // Activity level
                'choices' => [
                    'Sédentaire' => 1.2, // Sedentary
                    'Légèrement actif' => 1.375, // Lightly active
                    'Modérément actif' => 1.55, // Moderately active
                    'Très actif' => 1.725, // Very active
                    'Extrêmement actif' => 1.9, // Extremely active
                ],
            ])
            ->add('goal', ChoiceType::class, [
                'label' => 'Objectif', // Goal
                'choices' => [
                    'Perdre du poids' => -500, // Lose weight
                    'Maintenir le poids' => 0, // Maintain weight
                    'Prendre du poids' => 500, // Gain weight
                ],
            ])
            ->add('calculate', SubmitType::class, [
                'label' => 'Calculer', // Calculate
                'attr' => [
                    'class' => 'btn btn-primary',
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
