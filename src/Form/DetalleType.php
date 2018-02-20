<?php

namespace App\Form;

use App\Entity\Detalle;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class DetalleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('tipo',ChoiceType::class,array(
                'choices'  => array(
                    'Material' => 0,
                    'Servicio' => 1,
                )
              ))
            ->add('cantidad',NumberType::class)
            ->add('descripcion',TextType::class)
            ->add('medida',ChoiceType::class,array(
                'choices'  => array(
                    'Unidad' => 'UND',
                )))
            ->add('tiempo',ChoiceType::class,array(
                'choices'  => array(
                    'Dia' => 'D',
                )))
            ->add('valor',NumberType::class)
            ->add('save', SubmitType::class, array('label' => 'Agregar/Modificar Detalle'))

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // uncomment if you want to bind to a class
            'data_class' => Detalle::class,
        ]);
    }
}
