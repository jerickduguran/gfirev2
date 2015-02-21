<?php

namespace GFire\InvoiceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class InvoiceParticularEntryType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('amount')
            ->add('vatApplication','choice', array('placeholder'=> '--- ','choices' => array('VAT_EXEMPT' => 'VAT Exempt','VAT_ZERO_PERCENT' => 'Zero Rated Vat','VAT_INCLUSIVE' => 'VAT Inclusive','VAT_EXCLUSIVE' => 'VAT Exclusive')))
            ->add('total')
            ->add('taxFinalWithheld')
            ->add('taxExpandedWithheld')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'GFire\InvoiceBundle\Entity\InvoiceParticularEntry',
            'error_bubbling' => true,
            'cascade_validation' => true,
            'validation_groups' => array('Default')
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'gfire_invoicebundle_invoiceparticularentry';
    }
}
