<?php

namespace Epi\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Epi\AppBundle\Form\Type;

use Epi\AppBundle\Entity\Question;
use Epi\AppBundle\Entity\Category;
use Epi\AppBundle\Entity\User;

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

        $category = $this->getDoctrine()
            ->getRepository('EpiAppBundle:Category')
            ->findAll();

        if($this->getUser()->getId() == $question->getUser()->getId()){
            $userIsAuthor = true;
        }else{
            $userIsAuthor = false;
        }

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

        if (!empty($question)) {
            return $this->render('EpiAppBundle:Question:show.html.twig', array('question' => $question, 'categories' => $category, 'userIsAuthor' => $userIsAuthor));
        } else {
            $this->get('session')->getFlashBag()->set('error', 'question does not exist');
            return $this->redirect($this->generateUrl('home'));
        }

        return $this->render('EpiAppBundle:Question:show.html.twig');
    }
}
