<?php

namespace HGR\EntityBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class StoreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('addressLine1')
            ->add('addressLine2')
            ->add('postalCode')
            ->add('city')
            ->add('country')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'HGR\EntityBundle\Entity\Store'
        ));
    }

    public function getName()
    {
        return 'hgr_entitybundle_storetype';
    }
}
