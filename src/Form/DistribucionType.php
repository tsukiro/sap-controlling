<?php

namespace App\Form;

use App\Entity\Distribucion;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class DistribucionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('tipo',ChoiceType::class,array(
              'choices' => array(
                  'Simple' => true,
                  'Multiple' => false,
              )
            ))
            ->add('cantidad',NumberType::class)
            ->add('ceco',TextType::class)
            ->add('cuenta',NumberType::class)
            ->add('save',SubmitType::class,array('label' => 'Agregar/Modificar Distribución'))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // uncomment if you want to bind to a class
            //'data_class' => Distribucion::class,
        ]);
    }
}
