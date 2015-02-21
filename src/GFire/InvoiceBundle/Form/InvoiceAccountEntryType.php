<?php

namespace GFire\InvoiceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class InvoiceAccountEntryType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('chartOfAccount',null, array('placeholder' => ' --- '))
            ->add('generalLibrary',null, array('placeholder' => ' --- '))
            ->add('debit')
            ->add('credit')
           // ->add('project')
           // ->add('department')
           // ->add('invoice')
           // ->add('dnReference')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class'            => 'GFire\InvoiceBundle\Entity\InvoiceAccountEntry',
            'validation_groups'     =>  array('invoice_account_entry')
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'gfire_invoicebundle_invoiceaccountentry';
    }
}
