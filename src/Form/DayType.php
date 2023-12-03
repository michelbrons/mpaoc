<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DayType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('day_part', ChoiceType::class, [
                'choices' => [
                    'Part 1' => 1,
                    'Part 2' => 2,
                ],
            ])
            ->add('input_type', ChoiceType::class, [
                'choices' => [
                    'Preview'  => 'preview',
                    'Input' => 'input',
                ],
                'expanded' => true,
            ])
            ->add('input', TextareaType::class, [
                'required'   => false,
            ])
            ->add('save', SubmitType::class, ['label' => 'Get result'])
        ;
        $builder->setData(array(
            'input_type' => 'preview',
        ));
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
