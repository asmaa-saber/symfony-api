<?php

namespace AppBundle\Form;

use AppBundle\Entity\Category;
use AppBundle\Entity\Subcategory;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

class OrderItemType extends AbstractType
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
            ->add('order')
            ->add('name','text', array(
                'constraints' => array(
                    new NotBlank()
                )))
            ->add('quantity','integer', array(
                'constraints' => array(
                    new NotBlank()
                )))
            ->add('value','number', array(
                'scale' => 2,
                'constraints' => array(
                    new NotBlank()
                )))
            ->add('collection','entity',array(
                'class' => 'AppBundle:Collection',
                'choice_value' => 'id',
            ))
            ->add('tags', 'collection', array(
                'type' => new TagType(),
                'allow_add'    => true,
                'by_reference' => false
                ))
            ->addEventListener(FormEvents::PRE_SUBMIT, function (FormEvent $event) {
                $data = $event->getData();
                if (!$data) return;
                $data['quantity'] = $data['qnt'];
                $data['collection'] = $data['collection_id'];
                $category = $this->em->getRepository("AppBundle:Category")->findOneBy(['name'=> $data['category']]);
                if(!$category)
                {
                    $category = new Category();
                    $category->setName($data['category']);
                    $this->em->persist($category);
                    $this->em->flush();
                }
                $subcategory = $this->em->getRepository("AppBundle:Subcategory")->findOneBy(['name'=> $data['subcategory'], 'categoryId' => $category->getId()]);
                if(!$subcategory)
                {
                    $subcategory = new Subcategory();
                    $subcategory->setName($data['subcategory']);
                    $subcategory->setCategory($category);
                    $this->em->persist($subcategory);
                    $this->em->flush();
                }
                unset($data['qnt']);
                unset($data['collection_id']);
                $event->setData($data);
                $form = $event->getForm();
                $form->add('category','entity',array(
                    'class' => 'AppBundle:Category',
                    'choice_value' => 'name',
                ));
                $form->add('subcategory','entity',array(
                    'class' => 'AppBundle:Subcategory',
                    'choice_value' => 'name',
                ));
            })
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\OrderItem',
            'csrf_protection'   => false,
            'allow_extra_fields' => true
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'item';
    }
}
