<?php

namespace AppBundle\Form;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

class OrderType extends AbstractType
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('api_order_id','integer', array(
                'constraints' => array(
                    new NotBlank()
                )))
            ->add('customer','entity',array(
                'class' => 'AppBundle:Customer',
                'choice_value' => 'email',
                'constraints' => array(
                    new NotBlank()
                )
            ))
            ->add('total_amount_net','number', array(
                'scale' => 2,
                'constraints' => array(
                    new NotBlank()
                )))
            ->add('shipping_costs','number', array(
                'scale' => 2,
                'constraints' => array(
                    new NotBlank()
                )))
            ->add('payment_method','entity',array(
                'class' => 'AppBundle:PaymentMethod',
                'choice_value' => 'name',
                'constraints' => array(
                    new NotBlank()
                )
            ))
            ->add('orderItems', 'collection', array(
                'type' => new OrderItemType($this->em),
                'allow_add'    => true,
                'by_reference' => false
            ))
            ->addEventListener(FormEvents::PRE_SUBMIT, function (FormEvent $event) {
                $data = $event->getData();
                if (!$data) return;
                $data['customer'] = isset($data['email']) ? $data['email'] : '';
                $data['api_order_id'] = isset($data['order_id']) ? $data['order_id'] : '';
                $data['orderItems'] = isset($data['items']) ? $data['items'] : array();
                unset($data['email']);
                unset($data['order_id']);
                $event->setData($data);
            })
        ;

    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Order',
            'csrf_protection'   => false,
            'allow_extra_fields' => true
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'order';
    }
}
