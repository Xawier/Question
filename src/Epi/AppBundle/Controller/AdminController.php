<?php
/**
 * AdminController
 *
 * PHP version 5.3.3
 *
 * @category Class
 * @package  Epi\AppBundle
 * @author   Mateusz Haber <mateusz.haber@uj.edu.pl>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://wierzba.wzks.uj.edu.pl/~11_haber/Question/
 */
namespace Epi\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

use Symfony\Component\HttpFoundation\Request;
use Epi\AppBundle\Form\Type;

/**
 * Class AdminController
 * @package Epi\AppBundle\Controller
 */
class AdminController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $countQuestions = $this->getDoctrine()
            ->getRepository('EpiAppBundle:Question')
            ->countQuestions();

        $countAnswers = $this->getDoctrine()
            ->getRepository('EpiAppBundle:Answer')
            ->countAnswers();

        $countUsers = $this->getDoctrine()
            ->getRepository('EpiAppBundle:User')
            ->countUsers();

        $countCategories = $this->getDoctrine()
            ->getRepository('EpiAppBundle:Category')
            ->countCategories();

        return $this->render(
            'EpiAppBundle:Admin:index.html.twig',
            array('countQuestions' => $countQuestions,
                'countCategories' => $countCategories,
                'countAnswers' => $countAnswers,
                'countUsers' => $countUsers)
        );
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function usersAction()
    {
        $users = $this->getDoctrine()
            ->getRepository('EpiAppBundle:User')
            ->findAll();

        return $this->render(
            'EpiAppBundle:Admin:users.html.twig',
            array('users' => $users)
        );
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function categoriesAction()
    {
        $categories = $this->getDoctrine()
            ->getRepository('EpiAppBundle:Category')
            ->findAll();

        return $this->render(
            'EpiAppBundle:Admin:categories.html.twig',
            array(
                'categories' => $categories)
        );
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function questionsAction()
    {
        $questions = $this->getDoctrine()
            ->getRepository('EpiAppBundle:Question')
            ->findAll();

        return $this->render(
            'EpiAppBundle:Admin:questions.html.twig',
            array(
                'questions' => $questions)
        );
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function answersAction()
    {
        $answers = $this->getDoctrine()
            ->getRepository('EpiAppBundle:Answer')
            ->findAll();

        return $this->render(
            'EpiAppBundle:Admin:answers.html.twig',
            array('answers' => $answers)
        );
    }
}