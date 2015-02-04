<?php

// src/Acme/AccountBundle/Form/Type/UserType.php
namespace Epi\AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('username', 'text', array('attr'  => array('class' => 'form-control', 'placeholder' => 'Username')));
        $builder->add('email', 'email', array('attr'  => array('class' => 'form-control', 'placeholder' => 'Email')));
        $builder->add('password', 'repeated', array(
           'first_name'  => 'password',
           'second_name' => 'confirm',
           'type'        => 'password',
           'options' => array('attr' => array('class' => 'form-control', 'placeholder' => 'Password', 'label' => null)),
        ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Epi\AppBundle\Entity\User'
        ));
    }

    public function getName()
    {
        return 'user';
    }
}