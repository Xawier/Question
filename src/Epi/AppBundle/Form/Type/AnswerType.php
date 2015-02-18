<?php

namespace Epi\AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;


class AnswerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        	->add('value', 'textarea', array('attr'  => array('class' => 'form-control comment-textarea', 'id' => 'message-text', 'rows' => '3', 'placeholder' => 'Do you know answer?')));
    }

    public function getName()
    {
        return 'AppBundleFormTypeAnswerType';
    }

}