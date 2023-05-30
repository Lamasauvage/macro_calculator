<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\GreaterThan;
use Symfony\Component\Validator\Constraints\LessThan;
use Symfony\Component\Validator\Constraints\NotBlank;

class MacroCalculatorType extends AbstractType
{

    private const ACTIVITY_SEDENTARY = 1.2;
    private const ACTIVITY_LIGHTLY_ACTIVE = 1.375;
    private const ACTIVITY_MODERATELY_ACTIVE = 1.55;
    private const ACTIVITY_VERY_ACTIVE = 1.725;
    private const ACTIVITY_EXTREMELY_ACTIVE = 1.9;
    private const GOAL_LOSE = -400;
    private const GOAL_GAIN = 400;
    private const GOAL_MAINTAIN = 0;



    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('weight', NumberType::class, [
                'label' => 'Poids (kg)', // Weight (kg)
                'constraints' => [
                    new NotBlank(['message' => 'Veuillez entrer votre poids.']),
                    new GreaterThan([
                        'value' => 0,
                        'message' => 'Veuillez entrer un poids supérieur à 0.',
                    ]),
                    new LessThan([
                        'value' => 500,
                        'message' => 'Veuillez entrer un poids raisonnable.',
                    ])
                ],
            ])
            ->add('height', NumberType::class, [
                'label' => 'Taille (cm)',
                'constraints' => [
                    new NotBlank(['message' => 'Veuillez entrer votre taille.']),
                    new GreaterThan([
                        'value' => 0,
                        'message' => 'Veuillez entrer une taille supérieure à 0.',
                    ]),
                    new LessThan([
                        'value' => 250,
                        'message' => 'Veuillez entrer une taille raisonnable.',
                    ]),
                ],
            ])
            ->add('age', NumberType::class, [
                'label' => 'Âge',
                'constraints' => [
                    new NotBlank(['message' => 'Veuillez entrer votre âge.']),
                    new GreaterThan([
                        'value' => 0,
                        'message' => 'Veuillez entrer un âge supérieur à 0.',
                    ]),
                    new LessThan([
                        'value' => 150,
                        'message' => 'Veuillez entrer un âge raisonnable.',
                    ]),
                ],
            ])
            ->add('gender', ChoiceType::class, [
                'label' => 'Sexe',
                'constraints' => [
                    new NotBlank(['message' => 'Veuillez sélectionner votre sexe.']),
                ],
                'choices' => [
                    'Homme' => 'homme', // Male
                    'Femme' => 'femme', // Female
                ],
            ])
            ->add('activityLevel', ChoiceType::class, [
                'label' => 'Niveau d\'activité', // Activity level
                'constraints' => [
                    new NotBlank(['message' => 'Veuillez sélectionner votre niveau d\'activité.']),
                ],
                'choices' => [
                    'Sédentaire' => self::ACTIVITY_SEDENTARY, // Sedentary
                    'Légèrement actif' => self::ACTIVITY_LIGHTLY_ACTIVE, // Lightly active
                    'Modérément actif' => self::ACTIVITY_MODERATELY_ACTIVE, // Moderately active
                    'Très actif' => self::ACTIVITY_VERY_ACTIVE, // Very active
                    'Extrêmement actif' => self::ACTIVITY_EXTREMELY_ACTIVE, // Extremely active
                ],
            ])
            ->add('goal', ChoiceType::class, [
                'label' => 'Objectif', // Goal
                'constraints' => [
                    new NotBlank(['message' => 'Veuillez sélectionner votre objectif.']),
                ],
                'choices' => [
                    'Perdre du poids' => self::GOAL_LOSE, // Lose weight
                    'Maintenir le poids' => self::GOAL_MAINTAIN, // Maintain weight
                    'Prendre du poids' => self::GOAL_GAIN, // Gain weight
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
