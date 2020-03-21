<?php

namespace App\Form;

use App\Entity\Cita;
use App\Entity\Doctor;
use App\Entity\Paciente;
use App\Entity\TipoCita;
use App\Repository\DoctorRepository;
use App\Repository\PacienteRepository;
use App\Repository\TipoCitaRepository;
use AppBundle\Form\DataTransformer\DateTimeTransformer;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Valid;

class CitaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('paciente',EntityType::class, [
                'label'=>'Paciente *',
                'attr'=>['class'=>'selectize'],
                'class' => Paciente::class,
                'query_builder' => function (PacienteRepository $er) {
                    return $er->createQueryBuilder('s')->select('s')->orderBy('s.nombre', 'ASC');
                }
            ])
            ->add('fechaHora', TextType::class, array(
                'label'=>'Fecha Hora *',
                'attr'=>array('class'=>'form-control datetimepicker', 'placeholder'=>'Fecha y hora', 'readonly'=>true),
                'required'=>true
            ))
            ->add('tipo',EntityType::class, [
                'label'=>'Tipo de Cita *',
                'attr'=>['class'=>'form-control'],
                'class' => TipoCita::class,
                'query_builder' => function (TipoCitaRepository $tipo) {
                    return $tipo->createQueryBuilder('s')->select('s');
                }
            ])
            ->add('descripcion', TextareaType::class,array(
                'label'=>'Descripcion *',
                'attr'=>array('class'=>'form-control', 'placeholder'=>'Descripcion'),
                'required'=>true
            ))
            ->add('doctor',EntityType::class, [
                'label'=>'Doctor *',
                'attr'=>['class'=>'form-control'],
                'class' => Doctor::class,
                'query_builder' => function (DoctorRepository $er) {
                    return $er->createQueryBuilder('s')->select('s, u')->join('s.usuario', 'u')->orderBy('u.nombre', 'ASC');
                }
            ]);
        $builder->get('fechaHora')
            ->addModelTransformer(new DateTimeTransformer());
    } 

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Cita::class
        ]);
    }
}
