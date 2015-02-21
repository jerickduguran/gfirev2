<?php

namespace GFire\CoreBundle\Form\Tax;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FinalWithheldType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('code')
            ->add('title')
            ->add('natureOfIncomePayment')
            ->add('ratePercentage')
            //->add('generalLibraries')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'GFire\CoreBundle\Entity\Tax\FinalWithheld'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'gfire_corebundle_tax_finalwithheld';
    }
}
