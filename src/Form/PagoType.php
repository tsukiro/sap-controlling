<?php

namespace App\Form;

use App\Entity\Pago;
use App\Entity\Usuario;
use App\Entity\Proveedor;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class PagoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('descripcion', TextType::class)
        ->add('usuario', EntityType::class,array(
            'class' => Usuario::class,
            'choice_label' => 'nombre',
        ))
        ->add('factura',TextType::class)
        ->add('proveedor', EntityType::class,array(
            'class' => Proveedor::class,
            'choice_label' => 'nombre',
        ))

        ->add('tipo', ChoiceType::class,array(
            'choices'  => array(
                'Material' => 0,
                'Servicio' => 1,
            )))
        ->add('estado', ChoiceType::class,array(
          'choices' => array(
              'Pendiente' => 0,
              'Finalizado' => 1,
              'Anulado' => 2,
          )))
        //->add('fecha', DateType::class,array("data" => new \DateTime("now")))
        ->add('save', SubmitType::class, array('label' => 'Agregar/Modificar Pago'))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // uncomment if you want to bind to a class
            //'data_class' => Pago::class,
        ]);
    }
}
