<?php

// src/Acme/AccountBundle/Form/Type/UserType.php
namespace Epi\AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SettingsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('ad', 'text', array('attr'  => array('class' => 'form-control', 'placeholder' => 'Paste your ad code frome adsense')));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Epi\AppBundle\Entity\User'
        ));
    }

    public function getName()
    {
        return 'settings';
    }
}