<?php
/**
 * AnswerType
 *
 * PHP version 5.3.3
 *
 * @category Class
 * @package  Epi\AppBundle
 * @author   Mateusz Haber <mateusz.haber@uj.edu.pl>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://wierzba.wzks.uj.edu.pl/~11_haber/Question/
 */

namespace Epi\AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;


/**
 * Class AnswerType
 *
 * @category Entity
 * @package  Epi\AppBundle\Form\Type
 * @author   Mateusz Haber <mateusz.haber@uj.edu.pl>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://wierzba.wzks.uj.edu.pl/~11_haber/Question/
 */
class AnswerType extends AbstractType
{
    /**
     * BuildForm
     *
     * @param FormBuilderInterface $builder builder
     * @param array                $options options
     *
     * @return nothing
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        	->add(
                'value', 'textarea', array('attr'  => array('class' => 'form-control comment-textarea', 'id' => 'message-text', 'rows' => '3', 'placeholder' => 'Do you know answer?')));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'AppBundleFormTypeAnswerType';
    }

}