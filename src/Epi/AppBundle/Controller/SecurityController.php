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

    public function registerAction()
    {
        $form = $this->createForm(
            new Type\UserType()
        );

        return $this->render(
            'EpiAppBundle:Security:register.html.twig',
            array('form' => $form->createView())
        );
    }

    public function createAction(Request $request)
    {
        $user = new User();
        $registrationForm = $this->createForm(new Type\UserType(), $user);

        if ($request->isMethod('post')) {

            $registrationForm->bindRequest($request);

            if ($registrationForm->isValid()) {
                $user = new User();
                $user = $registrationForm->getData();
                $factory = $this->get('security.encoder_factory');
                $encoder = $factory->getEncoder($user);

                $user->setPassword($encoder->encodePassword($user->getPassword(), $user->getSalt()));

                $em = $this->getDoctrine()->getManager();

                $em->persist($user);
                $em->flush();

            }

        }

        return $this->render('EpiAppBundle:Security:register.html.twig', array('form' => $registrationForm->createView()));
    

        // $em = $this->getDoctrine()->getManager();

        // $form = $this->createForm(new RegistrationType(), new Registration());

        // $form->bindRequest($request);

        // if ($form->isValid()) {
        //     $registration = $form->getData();

        //     $factory = $this->get('security.encoder_factory');

        //     $encoder = $factory->getEncoder($registration);
        //     $password = $encoder->encodePassword('ryanpass', null);
        //     $registration->setPassword($password);

        //     $em->persist($registration->getUser());
        //     $em->flush();

        //     return $this->redirect('EpiAppBundle:Security:login.html.twig');
        // }

    }
}