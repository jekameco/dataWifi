<?php

namespace App\Form;

use App\Entity\Estudiantes;
use App\Entity\Materias;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints\Type;

class CalificacionesType extends AbstractType
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
            ->add('NombreEstudiante', EntityType::class, [
                'placeholder' => 'Seleccione un estudiante',
                'empty_data' => ' ',
                
                'attr' => [
                    'autocomplete' => 'off',
                    'class' => 'form-control',
                    'required' => true
                ],
                    'class' => Estudiantes::class,
                    'choice_label' => 'Nombre',
                    'choice_value' => 'Nombre',
                    'expanded' => false,
                    'multiple' => false
                ]
            )
            ->add('NombreMateria', EntityType::class, [
                'placeholder' => 'Seleccione una materia',
                'attr' => [
                    'autocomplete' => 'off',
                    'class' => 'form-control',
                    'required' => true
                ],
                    'class' => Materias::class,
                    'choice_label' => 'NombreMateria',
                    'choice_value' => 'NombreMateria',
                    'expanded' => false,
                    'multiple' => false
                ]
            )
            ->add('CalificacionFinal', IntegerType::class, [
                'label' => 'Calificacion Final',
                'attr' => [
                    'placeholder' => 'Calificacion final',
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
      /* $builder->get('NombreEstudiante')
        ->addModelTransformer(new CallbackTransformer(
            function ($array) {
                return $array;
            },
            function ($array) {
                return json_encode($array);
            }
        ));
        $builder->get('NombreMateria')
        ->addModelTransformer(new CallbackTransformer(
            function ($array) {
                return $array;
            },
            function ($array) {
                return json_encode($array);
            }
        ));*/
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
