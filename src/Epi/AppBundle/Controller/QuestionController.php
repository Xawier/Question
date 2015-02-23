<?php
/**
 * QuestionController
 *
 * PHP version 5.3.3
 *
 * @category Controller
 * @package  Epi\AppBundle
 * @author   Mateusz Haber <mateusz.haber@uj.edu.pl>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://wierzba.wzks.uj.edu.pl/~11_haber/Question/
 */
namespace Epi\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Epi\AppBundle\Form\Type;

use Epi\AppBundle\Entity\Question;
use Epi\AppBundle\Entity\Category;
use Epi\AppBundle\Entity\User;
use Epi\AppBundle\Entity\Answer;

class QuestionController extends Controller
{
	public function indexAction(Request $request)
    {
    	$question = new Question();
        $form = $this->createForm(new Type\QuestionType(), $question);

        $category = $this->getDoctrine()
            ->getRepository('EpiAppBundle:Category')
            ->getCategories();
            
        return $this->render('EpiAppBundle:Question:index.html.twig', array('categories' => $category, 'form' => $form->createView(), 'error' => $form->getErrorsAsString()));
    }

    public function addAction(Request $request)
    {
        /*ROLE AUTHENTICATION*/
        if (true !== $this->get('security.context')->isGranted('ROLE_USER')) {
                return $this->redirect($this->generateUrl('register'));
        }

    	$question = new Question();
        $form = $this->createForm(new Type\QuestionType(), $question);

    	if ($request->isMethod('post')) {

    		$form->bindRequest($request);

            if ($form->isValid()) {

            	$user = new User();
            	$user = $this->get('security.context')->getToken()->getUser();

    			$question = $form->getData();
    			$question->setDate(new \DateTime());
    			$question->setUser($user);

                $em = $this->getDoctrine()->getManager();

                $em->persist($question);
                $em->flush();

                return $this->redirect($this->generateUrl('show_question', array('questionId' => $question->getId())));

            }
    
        }

        return $this->render('EpiAppBundle:Question:index.html.twig');
    }

    public function showAction(Request $request)
    {
        
        $questionId = $request->get('questionId');

        $question = $this->getDoctrine()
            ->getRepository('EpiAppBundle:Question')
            ->find($questionId);

        $categories = $this->getDoctrine()
            ->getRepository('EpiAppBundle:Category')
            ->findAll();

        $answers = $this->getDoctrine()
            ->getRepository('EpiAppBundle:Question')
            ->getQuestionAnswers($questionId);

        $userIsAuthor = $this->getDoctrine()
            ->getRepository('EpiAppBundle:Question')
            ->isAuthor($question,$this->getUser());

        $ad = $this->getDoctrine()
            ->getRepository('EpiAppBundle:Question')
            ->getAD($question);

        if($request->isXmlHttpRequest())
        {
            if($userIsAuthor)
            {
                $categoryId = $this->get('request')->request->get('categoryId');

                $category = $this->getDoctrine()
                ->getRepository('EpiAppBundle:Category')
                ->find($categoryId);

                $question->setCategory($category);

                $em = $this->getDoctrine()->getManager();

                $em->persist($question);
                $em->flush();
            }
        }

        $form_cover = $this->createForm(new Type\CoverType(),$question);

        $answer = new Answer();
        $form_answer = $this->createForm(new Type\AnswerType(),$answer);

        if (empty($question)) {
            $this->get('session')->getFlashBag()->set('error', 'question does not exist');
            return $this->redirect($this->generateUrl('home'));
        } elseif($question->getActive() == 0) {
            $this->get('session')->getFlashBag()->set('error', 'question is deleteed');
            return $this->redirect($this->generateUrl('home'));
        } else {
            return $this->render('EpiAppBundle:Question:show.html.twig', array('question' => $question, 'ad' => $ad, 'form_cover' => $form_cover->createView(), 'answers' => $answers, 'categories' => $categories, 'userIsAuthor' => $userIsAuthor, 'form_answer' => $form_answer->createView(), 'error_answer' => $form_answer->getErrorsAsString()));
        }

        return $this->render('EpiAppBundle:Question:show.html.twig');
    }

    public function setBestAnswerAction(Request $request){

        $questionId = $request->get('questionId');
        $answerId = $request->get('answerId');

        $question = $this->getDoctrine()
            ->getRepository('EpiAppBundle:Question')
            ->find($questionId);

        $answer = $this->getDoctrine()
            ->getRepository('EpiAppBundle:Answer')
            ->find($answerId);

        $userIsAuthor = $this->getDoctrine()
            ->getRepository('EpiAppBundle:Question')
            ->isAuthor($question,$this->getUser());

        if($userIsAuthor)
        {
            $question->setBestAnswer($answer);
                    
            $em = $this->getDoctrine()->getManager();
            $em->persist($question);
            $em->flush();
        }

        $url = $this->generateUrl('show_question', array('questionId' => $questionId));
        return $this->redirect($url);
    }

    public function uploadAction(Request $request){

        $questionId = $request->get('questionId');

        $question = $this->getDoctrine()
            ->getRepository('EpiAppBundle:Question')
            ->find($questionId);

        $form = $this->createForm(new Type\CoverType(), $question);


        if ($request->isMethod('post')) {
            $form->bindRequest($request);
            if ($form->isValid()) {
                $form = $form->getData();
                $em = $this->getDoctrine()->getManager();

                $question->upload();

                $em->persist($form);
                $em->flush();
            }
        }

        $url = $this->generateUrl('show_question', array('questionId' => $questionId));
                return $this->redirect($url);
    }

    public function deleteAction(Request $request)
    {
        
        $questionId = $request->get('questionId');

        $question = $this->getDoctrine()
            ->getRepository('EpiAppBundle:Question')
            ->find($questionId);

        $question->setActive(0);
        
        $em = $this->getDoctrine()->getManager();
        $em->persist($question);
        $em->flush();

        return $this->redirect($request->headers->get('referer'));


    }

    public function restoreAction(Request $request)
    {
        $questionId = $request->get('questionId');

        $question = $this->getDoctrine()
            ->getRepository('EpiAppBundle:Question')
            ->find($questionId);

        $question->setActive(1);
        
        $em = $this->getDoctrine()->getManager();
        $em->persist($question);
        $em->flush();

        return $this->redirect($request->headers->get('referer'));


    }
}
