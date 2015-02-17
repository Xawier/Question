<?php

namespace Epi\AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class QuestionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('value', 'text', array('attr'  => array('class' => 'form-control', 'placeholder' => 'Where do babies come from?')));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Epi\AppBundle\Entity\Question'
        ));
    }

    public function getName()
    {
        return 'question';
    }
}