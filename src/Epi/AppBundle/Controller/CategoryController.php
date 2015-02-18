<?php

namespace Epi\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Epi\AppBundle\Form\Type;

use Epi\AppBundle\Entity\Question;
use Epi\AppBundle\Entity\Category;
use Epi\AppBundle\Entity\User;

class CategoryController extends Controller
{
    public function showAction(Request $request)
    {

        $categoryId = $request->get('categoryId');

        $category = $this->getDoctrine()
            ->getRepository('EpiAppBundle:Category')
            ->find($categoryId);

        $questions = $this->getDoctrine()
            ->getRepository('EpiAppBundle:Category')
            ->getCategoryQuestions($categoryId);

        if (!empty($category)) {
            return $this->render('EpiAppBundle:Category:show.html.twig', array('questions' => $questions, 'category' => $category));
        } else {
            $this->get('session')->getFlashBag()->set('error', 'question does not exist');
            return $this->redirect($this->generateUrl('home'));
        }

        return $this->render('EpiAppBundle:Category:show.html.twig');
    }
}
