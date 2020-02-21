<?php

namespace App\Form;

use App\Entity\Consultorio;
use App\Entity\Doctor;
use App\Entity\Especialidad;
use App\Entity\Secretaria;
use App\Repository\ConsultorioRepository;
use App\Repository\EspecialidadRepository;
use App\Repository\SecretariaRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EditDoctorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('email',EmailType::class,array(
            'attr'=>array('class'=>'form-control','placeholder'=>'Correo Electronico'),
            'required'=>true
        ))
        ->add('especialidad', EntityType::class, [
            'attr'=>['class'=>'form-control'],
            'class' => Especialidad::class,
            'query_builder' => function (EspecialidadRepository $er) {
                return $er->createQueryBuilder('u')->orderBy('u.nombre', 'ASC');
            },
            'choice_label' => 'nombre',
        ])
        ->add('consultorio', EntityType::class, [
            'attr'=>['class'=>'form-control'],
            'class' => Consultorio::class,
            'query_builder' => function (ConsultorioRepository $er) {
                return $er->createQueryBuilder('u')->orderBy('u.nombre', 'ASC');
            },
            'choice_label' => 'nombre',
        ])
        ->add('secretaria', EntityType::class, [
            'attr'=>['class'=>'form-control'],
            'class' => Secretaria::class,
            'query_builder' => function (SecretariaRepository $er) {
                return $er->createQueryBuilder('s')->select('s, u')->join('s.usuario', 'u')->orderBy('u.nombre', 'ASC');
            }
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Doctor::class,
        ]);
    }
}
