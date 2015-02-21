<?php

namespace GFire\CoreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;

use GFire\CoreBundle\Entity\ChartOfAccount\Type;

class ChartOfAccountType extends AbstractType
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
            ->add('description')
            ->add('enabled')
            ->add('type')
            ->add('group')
        ;

        $formModifier = function (FormInterface $form, Type $type = null) {
            $validations = null === $type ? array() : $type->getValidations();
            $form->add('validations', 'entity', array(
                'class'       => 'GFire\CoreBundle\Entity\ChartOfAccount\Validation',
                'placeholder' => '',
                'choices'     => $validations,
                'property'    => 'name',
                'expanded'    => true,
                'multiple'    => true
            ));
        };

        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) use ($formModifier) {
                $data = $event->getData();
                $formModifier($event->getForm(), $data->getType());
            }
        );

        $builder->get('type')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) use ($formModifier) {
                $type = $event->getForm()->getData();
                $formModifier($event->getForm()->getParent(), $type);
            }
        );
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'GFire\CoreBundle\Entity\ChartOfAccount'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'gfire_corebundle_chartofaccount';
    }
}
