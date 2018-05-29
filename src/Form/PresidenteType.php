<?php

namespace App\Form;

use App\Entity\Presidente;
use App\Entity\Pais;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PresidenteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('fechanac', DateType::class, array(
               'label' => 'Date',
               'format' => 'dd MM yyyy',
               'required' => true
            ))
            ->add('pais')
           
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Presidente::class,
        ]);
    }
}
