<?php

namespace App\Controller;

use App\Form\MacroCalculatorType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class macroCalculator extends AbstractController
{
    #[Route('/', name: 'macro_calculator')]
    public function macroCalculator(Request $request, bool $isRefreshed=false): Response
    {
        $form = $this->createForm(MacroCalculatorType::class);
        $result = null;

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $result = $this->calculateMacros($data['weight'], $data['height'], $data['age'], $data['activityLevel'], $data['gender'], $data['goal']);
            // You might want to do something with the result here,
            // like storing it in the database, displaying it to the user, etc.
            // For now, we'll just dump it.
            dump($result);

            // Reset the form data if the page has been refreshed
            if ($isRefreshed) {
                $form = $this->createForm(MacroCalculatorType::class);
            }

            return $this->render('base.html.twig', [
                'form' => $form->createView(),
                'result' => $result,
            ]);
        }

        return $this->render('base.html.twig', [
            'form' => $form->createView(),
            'result' => $result,
        ]);
    }

    public function calculateMacros($weight, $height, $age, $activityLevel, $gender, $goal): array
    {
        // Calculate BMR using Mifflin-St Jeor Equation (https://en.wikipedia.org/wiki/Harris%E2%80%93Benedict_equation)
        if ($gender === 'homme') {
            $bmr = 10 * $weight + 6.25 * $height - 5 * $age + 5;
        } else {
            $bmr = 10 * $weight + 6.25 * $height - 5 * $age - 161;
        }

        // Calculate TDEE
        $tdee = $bmr * $activityLevel;

        // Adjust TDEE based on goal
        $adjustedTdee = $tdee + $goal;

        // Calculate macros using the adjusted TDEE
        $carbs = $adjustedTdee * 0.40 / 4;
        $protein = $adjustedTdee * 0.30 / 4;
        $fats = $adjustedTdee * 0.30 / 9;

        return ['calories' => $adjustedTdee, 'protein' => $protein, 'fats' => $fats, 'carbs' => $carbs];
    }

}