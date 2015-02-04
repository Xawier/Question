<?php

namespace Epi\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

use Symfony\Component\HttpFoundation\Request;
use Epi\AppBundle\Form\Type;

use Epi\AppBundle\Entity\User;

class SecurityController extends Controller
{
    public function loginAction()
    {
        /*ROLE AUTHENTICATION*/
        if (true === $this->get('security.context')->isGranted('ROLE_USER')) {
                return $this->redirect($this->generateUrl('log_index'));
        }

        $request = $this->getRequest();
        $session = $request->getSession();

        // get the login error if there is one
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(
                SecurityContext::AUTHENTICATION_ERROR
            );
        } else {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        }
        
        return $this->render(
            'EpiAppBundle:Security:login.html.twig',
            array(
                // last username entered by the user
                'last_username' => $session->get(SecurityContext::LAST_USERNAME),
                'error'         => $error,
            )
        );
    }

    public function registerAction(Request $request)
    {
        $user = new User();
        $form = $this->createForm(new Type\UserType(), $user);

        if ($request->isMethod('post')) {

            $form->bindRequest($request);

            if ($form->isValid()) {
                $user = new User();
                $user = $form->getData();
                $factory = $this->get('security.encoder_factory');
                $encoder = $factory->getEncoder($user);

                $user->setPassword($encoder->encodePassword($user->getPassword(), $user->getSalt()));

                $em = $this->getDoctrine()->getManager();

                $em->persist($user);
                $em->flush();
                return $this->render('EpiAppBundle:Security:login.html.twig', array('last_username' => $user->getUsername(), 'error' => null));
    
            }

        }

        return $this->render('EpiAppBundle:Security:register.html.twig', array('form' => $form->createView(), 'error' => $form->getErrorsAsString()));
    
    }
}