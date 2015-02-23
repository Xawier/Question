<?php
/**
 * QuestionType
 *
 * PHP version 5.3.3
 *
 * @category Type
 * @package  Epi\AppBundle
 * @author   Mateusz Haber <mateusz.haber@uj.edu.pl>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://wierzba.wzks.uj.edu.pl/~11_haber/Question/
 */
namespace Epi\AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class QuestionType
 *
 * @category Type
 * @package  Epi\AppBundle\Form\Type
 * @author   Mateusz Haber <mateusz.haber@uj.edu.pl>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://wierzba.wzks.uj.edu.pl/~11_haber/Question/
 */
class QuestionType extends AbstractType
{
    /**
     * BuildForm
     *
     * @param FormBuilderInterface $builder builder
     * @param array                $options options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'value',
            'text',
            array(
                'attr'  => array(
                    'class' => 'form-control',
                    'placeholder' => 'Where do babies come from?')
            )
        );
    }

    /**
     * SetDefaultOptions
     *
     * @param OptionsResolverInterface $resolver resolver
     *
     * @return nothing
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array(
            'data_class' => 'Epi\AppBundle\Entity\Question'
            )
        );
    }

    /**
     * GetName
     *
     * @return string
     */
    public function getName()
    {
        return 'question';
    }
}