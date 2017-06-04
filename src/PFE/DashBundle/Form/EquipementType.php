<?php

namespace PFE\DashBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EquipementType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('isDisponible','choice', array(
                'choices'  => array(
                    'Disponible' => 1,
                    'Non disponible' => 0),
                'choices_as_values' => true,
            ))
            ->add('nombre')
            ->add('nombre_endommage')
            ->add('nombre_nutilisable')
            //->add('created')
            ->add('typeequipement','entity', array(
                'class' =>  'PFE\DashBundle\Entity\Typeequipement',
                'property' => 'nom'
            ))
            ->add('espace','entity', array(
                'class' =>  'PFE\DashBundle\Entity\Espace',
                'property' => 'typeespace.nom'
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PFE\DashBundle\Entity\Equipement'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'pfe_dashbundle_equipement';
    }
}
