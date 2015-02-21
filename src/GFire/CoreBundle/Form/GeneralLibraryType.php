<?php

namespace GFire\CoreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class GeneralLibraryType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('code')
            ->add('name')
            ->add('active')
            ->add('addressStreet1')
            ->add('addressStreet2')
            ->add('addressCity')
            ->add('addressPostcode')
            ->add('addressRegion')
            ->add('addressCountry')
            ->add('telephoneNumber')
            ->add('faxNumber')
            ->add('mobileNumber')
            ->add('website')
            ->add('emailAddress')
            ->add('contactPerson')
            ->add('contactPersonPosition')
            ->add('tinNumber')
            ->add('discountRate')
            ->add('drawingNumber')
            ->add('specsNumber')
            ->add('billTo')
            ->add('billingAddress1')
            ->add('billingAddress2')
            ->add('attention')
            ->add('finalWithheldTaxes')
            ->add('expandedWithheldTaxes')
            ->add('category')
            ->add('industry')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'GFire\CoreBundle\Entity\GeneralLibrary'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'gfire_corebundle_generallibrary';
    }
}
