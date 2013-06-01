<?php

namespace HGR\EntityBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('origin')
            ->add('brand')
            ->add('tags')
            ->add('imageURL')
            ->add('attributes')
            ->add('price')
            ->add('name')
            ->add('category')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'HGR\EntityBundle\Entity\Product'
        ));
    }

    public function getName()
    {
        return 'hgr_entitybundle_producttype';
    }
}
