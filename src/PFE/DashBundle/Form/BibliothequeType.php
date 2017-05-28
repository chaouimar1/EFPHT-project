<?php

namespace PFE\DashBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BibliothequeType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('dateCreation')
            ->add('superficie')
            ->add('adresse')
            ->add('tel')
            ->add('fax')
            ->add('email')
            ->add('dateInstallationInternet')
            ->add('isFormation')
            ->add('catalogue','entity', array(
                'class' =>  'PFE\DashBundle\Entity\Catalogue',
                'property' => 'nom'
            ))
            ->add('province','entity', array(
                'class' =>  'PFE\DashBundle\Entity\Province',
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
            'data_class' => 'PFE\DashBundle\Entity\Bibliotheque'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'pfe_dashbundle_bibliotheque';
    }
}
