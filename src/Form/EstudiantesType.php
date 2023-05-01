<?php

namespace App\Form;

use App\Entity\Estudiantes;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EstudiantesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('id_update',TextType::class,[
            'mapped' => false,
            'label' => false,
            'required' => false,
                'attr' => [
                    'placeholder' => 'Edad estudiante',
                    'class' => 'id_update hidden',

                ]
        ])
        
            ->add('nombre',TextType::class,[
                'label' => 'Nombre',
                'attr' => [
                    'placeholder' => 'Nombre estudiante',
                    'autocomplete' => 'off',
                    'class' => 'form-control',
                    'value'=> '',
                    'required' => true
                ]
            ])
            ->add('edad',IntegerType::class,[
                'label' => 'Edad',
                'attr' => [
                    'placeholder' => 'Edad estudiante',
                    'autocomplete' => 'off',
                    'class' => 'form-control',
                    'required' => true
                ]
            ])
            ->add('grado',TextType::class,[
                'label' => 'Grado',
                'attr' => [
                    'placeholder' => 'Grado estudiante',
                    'autocomplete' => 'off',
                    'class' => 'form-control',
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
            'data_class' => Estudiantes::class,
        ]);
    }
}
