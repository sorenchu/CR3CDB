<?php
# src/DatabaseBundle/Form/PlayerDataType.php

namespace DatabaseBundle\Form;

use DatabaseBundle\Entity\PlayerData;
use DatabaseBundle\Form\FormFactory\DataFormCreation;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;

use Doctrine\ORM\EntityRepository;

class PlayerDataType extends AbstractType implements DataFormCreation
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
        ->add('season', EntityType::class, array(
            'label' => 'Temporada',
            'class' => 'DatabaseBundle:Season',
            'query_builder' => function (EntityRepository $er) {
                  return $er->createQueryBuilder('season');
          },
          'required' => true,
          'multiple' => false,
          'expanded' => false,
          )
        )
        ->add('payment', MoneyType::class, array(
                                    'required' => true,
                                    'label' => 'Pagos',))
        ->add('category', ChoiceType::class, array(
            'label' => 'Categoría',
            'choices' => array(
              'senior' => 'Senior',
              'femenino' => 'Femenino',
              'cadete' => 'Cadete',
              //'infantil' => 'Infantil',
              'alevin' => 'Alevín',
              'benjamin' => 'Benjamín',
              'prebenjamin' => 'Prebenjamín',
              //'jabato' => 'Jabato',
              //'lince' => 'Lince',
            )
          )
        );
  }
  
  public function getBlockPrefix()
  {
    return 'playerData';
  }

  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults(array(
              'data_class' => PlayerData::class,
    ));
  }
}
?>