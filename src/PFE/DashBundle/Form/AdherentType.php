<?php

namespace PFE\DashBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AdherentType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            //->add('created')
            ->add('nom')
            ->add('prenom')
            ->add('dateNaissance','date', array(
                'years' => range(date("Y"),1930),
                'format' => 'yMMMMd',))
            //->add('age')
            ->add('sexe','choice', array(
                'choices'  => array(
                    'Homme' => 1,
                    'Femme' => 0),
                    'choices_as_values' => true,
            ))
            ->add('dateInscription')
            ->add('bibliotheque','entity', array(
                'class' =>  'PFEDashBundle:Bibliotheque',
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
            'data_class' => 'PFE\DashBundle\Entity\Adherent'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'pfe_dashbundle_adherent';
    }
}
