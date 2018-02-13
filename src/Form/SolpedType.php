<?php

namespace App\Form;

use App\Entity\Solped;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class SolpedType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numero')
            ->add('estado',ChoiceType::class,array(
                'choices'  => array(
                    'Pendiente' => 0,
                    'Solicitada' => 1,
                    'Aceptada' => 2,
                    'Rechazada' => 3,
                )))
            ->add('save', SubmitType::class, array(
              'label' => 'Agregar Solped'
            ))

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // uncomment if you want to bind to a class
            //'data_class' => Solped::class,
        ]);
    }
}
