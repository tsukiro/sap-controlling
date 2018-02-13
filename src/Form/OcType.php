<?php

namespace App\Form;

use App\Entity\OC;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class OcType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numero')
            ->add('estado',ChoiceType::class,array(
                'choices'  => array(
                    'Pendiente' => 0,
                    'Enviado a Proveedor' => 1,
                    'Finalizado' => 2,
                    'Anulado' => 3,
                )))
            ->add('observacion',TextareaType::class)
            ->add('save', SubmitType::class, array(
              'label' => 'Agregar OC'
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // uncomment if you want to bind to a class
            //'data_class' => Oc::class,
        ]);
    }
}
