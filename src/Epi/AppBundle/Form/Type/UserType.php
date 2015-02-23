<?php
/**
 * UserType
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
 * Class UserType
 *
 * @category Type
 * @package  Epi\AppBundle\Form\Type
 * @author   Mateusz Haber <mateusz.haber@uj.edu.pl>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://wierzba.wzks.uj.edu.pl/~11_haber/Question/
 */
class UserType extends AbstractType
{
    /**
     * BuildForm
     *
     * @param FormBuilderInterface $builder comment
     * @param array                $options comment
     *
     * @return nothing
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'username',
            'text',
            array(
                'attr'  => array(
                    'class' => 'form-control',
                    'placeholder' => 'Username'))
        );
        $builder->add(
            'email',
            'email',
            array(
                'attr'  => array(
                    'class' => 'form-control',
                    'placeholder' => 'Email'))
        );
        $builder->add(
            'password',
            'repeated',
            array(
            'first_name'  => 'password',
            'second_name' => 'confirm',
            'type'        => 'password',
            'options' => array(
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Password',
                    'label' => null)))
        );
    }

    /**
     * SetDefaultOptions
     *
     * @param OptionsResolverInterface $resolver comment
     *
     * @return nothing
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array(
            'data_class' => 'Epi\AppBundle\Entity\User'
            )
        );
    }

    /**
     * GetName
     *
     * @return string comment
     */
    public function getName()
    {
        return 'user';
    }
}