<?php

namespace Epi\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

use Symfony\Component\HttpFoundation\Request;
use Epi\AppBundle\Form\Type;

use Epi\AppBundle\Entity\User;

class AdminController extends Controller
{
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

        return $this->render('EpiAppBundle:Admin:index.html.twig', array('countQuestions' => $countQuestions, 'countCategories' => $countCategories, 'countAnswers' => $countAnswers, 'countUsers' => $countUsers));
    }

    public function usersAction()
    {
        $users = $this->getDoctrine()
            ->getRepository('EpiAppBundle:User')
            ->findAll();

        return $this->render('EpiAppBundle:Admin:users.html.twig', array('users' => $users));
    }

    public function categoriesAction()
    {
        $categories = $this->getDoctrine()
            ->getRepository('EpiAppBundle:Category')
            ->findAll();

        return $this->render('EpiAppBundle:Admin:categories.html.twig', array('categories' => $categories));
    }
}