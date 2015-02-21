<?php

namespace GFire\InvoiceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use GFire\InvoiceBundle\Entity\Invoice;

class InvoiceType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('book')
            ->add('invoiceNumber')
            ->add('purchaseOrderNumber')
            ->add('currency')
            ->add('dateReceived','date',array('widget' => 'single_text','attr' => array('placeholder' => 'YYYY-MM-DD')))
            ->add('invoiceDate','date',array('widget' => 'single_text','attr' => array('placeholder' => 'YYYY-MM-DD')))
            ->add('period','date',array('widget' => 'single_text','attr' => array('placeholder' => 'YYYY-MM-DD')))
            ->add('dueDate','date',array('widget' => 'single_text','attr' => array('placeholder' => 'YYYY-MM-DD')))
            ->add('termsOfPaymentDays')
            ->add('totalAmount')
            ->add('generalLibrary',null,array('placeholder' => '---'))
            ->add('termsOfPayment')
           /* ->add('status','choice',array('choices' => array(Invoice::STATUS_UNPAID      => 'Unpaid',Invoice::STATUS_PARTIALLY_PAID => 'Partially Paid',
                                                             Invoice::STATUS_FULLY_PAID  => 'Paid',  Invoice::STATUS_DUE => 'Due',
                                                             Invoice::STATUS_OVERDUE     => 'Over Due'),'placeholder' => ' --- ','data' =>Invoice::STATUS_UNPAID,'attr' => array('disabled' => true) ))

    */      ->add('status','choice',array('choices' => array(Invoice::STATUS_UNPAID      => 'Unpaid')))
           /* ->add('invoiceParticularEntries','collection',array( 'type'         => new InvoiceParticularEntryType(),
                                                                 'allow_add'      => true,
                                                                 'error_bubbling' => true))*/

           ->add('totalAccountEntry','hidden')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'GFire\InvoiceBundle\Entity\Invoice',
            'validation_groups' => array('Default'),
            'cascade_validation' => true,
            'error_bubbling' => true
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'gfire_invoicebundle_invoice';
    }
}
