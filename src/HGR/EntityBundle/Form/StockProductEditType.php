<?php

namespace HGR\EntityBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class StockProductEditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('amount')
            ->add('product',null,array('disabled'=>true))
            ->add('store',null,array('disabled'=>true))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'HGR\EntityBundle\Entity\StockProduct'
        ));
    }

    public function getName()
    {
        return 'hgr_entitybundle_stockproducttype';
    }
}
