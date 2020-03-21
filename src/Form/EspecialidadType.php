<?php

namespace App\Form;

use App\Entity\Especialidad;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EspecialidadType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre',TextType::class,array(
                'label'=>'Nombre *',
                'attr'=>array('class'=>'form-control form-control-user', 'placeholder'=>'Nombre de Consultorio'),
                'required'=>true
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Especialidad::class,
        ]);
    }
}
