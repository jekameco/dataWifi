<?php

namespace App\Form;

use DateTime;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DivisaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('date_divisa', DateType::class, [
            'mapped' => false,
            'label' => 'Fecha de la divisa',
            'required' => false,
            'widget' => 'single_text',
            'data' => new DateTime(),
            'attr' => [
                'class' => 'form-control',
                'placeholder' => 'Selecciona una fecha',
                
            ],
        ])
        ->add('submit',SubmitType::class,[
            'label' => 'Buscar',
            'attr' => [
                'class' => 'btn btn-primary'
            ]
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
             // Establecer la opción "data_class" a "null" para que no se mapee a una entidad de Doctrine
             'data_class' => null,
        ]);
    }
}
