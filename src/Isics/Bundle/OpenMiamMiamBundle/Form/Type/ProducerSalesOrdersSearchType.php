<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 24/06/14
 * Time: 16:19
 */

namespace Isics\Bundle\OpenMiamMiamBundle\Form\Type;


use Isics\Bundle\OpenMiamMiamBundle\Entity\Producer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProducerSalesOrdersSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->setMethod('get')
            ->add(
                'branchOccurrence',
                'entity',
                array(
                    'class' => 'Isics\Bundle\OpenMiamMiamBundle\Entity\BranchOccurrence',
                    'required' => false,
                )
            )
            ->add(
                'minDate',
                'date',
                array(
                    'widget'   => 'single_text',
                    'format'   => 'dd-MM-yyyy',
                    'input'    => 'datetime',
                    'required' => false,
                )
            )
            ->add(
                'maxDate',
                'date',
                array(
                    'widget'   => 'single_text',
                    'format'   => 'dd-MM-yyyy',
                    'input'    => 'datetime',
                    'required' => false,
                )
            )
            ->add(
                'minTotal',
                'money',
                array(
                    'required' => false,
                )
            )
            ->add(
                'maxTotal',
                'money',
                array(
                    'required' => false,
                )
            );
    }

    /**
     * @see AbstractType
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver
            ->setDefaults(array(
                'data_class' => 'Isics\Bundle\OpenMiamMiamBundle\Model\SalesOrder\ProducerSalesOrdersFilter',
            ))
            ->setRequired(['producer'])
            ->setAllowedTypes(['producer' => Producer::class]);
    }

    public function getName()
    {
        return 'open_miam_miam_producer_sales_order_search';
    }
} 