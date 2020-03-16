<?php

namespace App\Form;

use App\Entity\Paciente;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Valid;

class PacienteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre',TextType::class,array(
                'attr'=>array('class'=>'form-control', 'placeholder'=>'Nombre'),
                'required'=>true
            ))
            ->add('apellidos',TextType::class,array(
                'attr'=>array('class'=>'form-control', 'placeholder'=>'Apellidos'),
                'required'=>true
            ))
            ->add('telefono',NumberType::class,array(
                'attr'=>array('class'=>'form-control','placeholder'=>'telefono', 'type'=>'number'),
                'required'=>true
            ))
            ->add('correo',EmailType::class,array(
                'attr'=>array('class'=>'form-control','placeholder'=>'Correo Electronico'),
                'required'=>false
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Paciente::class,
        ]);
    }
}
