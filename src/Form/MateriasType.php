<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MateriasType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombremateria',TextType::class,[
                'label' => 'Nombre de la materia',
                'attr' => [
                    'placeholder' => 'Nombre de la materia',
                    'autocomplete' => 'off',
                    'class' => 'form-control',
                    'value'=> '',
                    'required' => true
                ]
            ])
            ->add('submit',SubmitType::class,[
                'label' => 'Guardar',
                'attr' => [
                    'class' => 'btn btn-primary'
                ]
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
