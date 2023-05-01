<?php

namespace App\Form;
use DateTime;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class GraficosType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('date_start', DateType::class, [
            'mapped' => false,
            'required' => false,
            'label' => 'Fecha inicial',
            'widget' => 'single_text',
            'data' => new DateTime(),
            'attr' => [
                'class' => 'form-control dateForGrafics',
                'placeholder' => 'Selecciona una fecha',
                
            ],
        ])
        ->add('date_end', DateType::class, [
            'mapped' => false,
            'required' => false,
            'label' => 'Fecha final',
            'widget' => 'single_text',
            'data' => new DateTime(),
            'attr' => [
                'class' => 'form-control dateForGrafics',
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
            // Configure your form options here
            'data_class' => null,
        ]);
    }
}
