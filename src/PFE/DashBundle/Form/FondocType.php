<?php

namespace PFE\DashBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FondocType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            //->add('created')
            ->add('typefondoc','entity', array(
                'class' =>  'PFE\DashBundle\Entity\Typefondoc',
                'property' => 'nom'
            ))
            ->add('bibliotheque','entity', array(
                'class' =>  'PFE\DashBundle\Entity\Bibliotheque',
                'property' => 'nom'
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PFE\DashBundle\Entity\Fondoc'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'pfe_dashbundle_fondoc';
    }
}
