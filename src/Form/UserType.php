<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre',TextType::class,array(
                'label'=>'Nombre *',
                'attr'=>array('class'=>'form-control', 'placeholder'=>'Nombre'),
                'required'=>true
            ))
            ->add('apellidos',TextType::class,array(
                'label'=>'Apellidos *',
                'attr'=>array('class'=>'form-control', 'placeholder'=>'Apellidos'),
                'required'=>true
            ))
            ->add('username',TextType::class,array(
                'label'=>'Usuario *',
                'attr'=>array('class'=>'form-control', 'placeholder'=>'Usuario'),
                'required'=>true
            ))
            ->add('password',RepeatedType::class, [
                'type' => PasswordType::class,
                'error_bubbling' => true,
                'invalid_message' => 'Las contraseñas no coinciden.',
                'options' => ['attr' => ['class' => 'form-control']],
                'required' => true,
                'first_options'  => ['label' => 'Password *','attr'=>['class' => 'form-control','placeholder'=>'Contraseña']],
                'second_options' => ['label' => 'Confirmar Password *','attr'=>['class' => 'form-control','placeholder'=>'Confirmar Contraseña']],
            ])            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
