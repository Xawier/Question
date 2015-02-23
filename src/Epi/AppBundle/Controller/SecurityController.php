<?php
/**
 * SecurityController
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
                return $this->redirect($this->generateUrl('home'));
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
        /*ROLE AUTHENTICATION*/
        if (true === $this->get('security.context')->isGranted('ROLE_USER')) {
                return $this->redirect($this->generateUrl('home'));
        }

        $user = new User();
        $form = $this->createForm(new Type\UserType(), $user);

        if ($request->isMethod('post')) {

            $form->bindRequest($request);

            if ($form->isValid()) {
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

    public function settingsAction(Request $request)
    {
        $userId = $request->get('userId');

        /*ROLE AUTHENTICATION*/
        if (true != $this->get('security.context')->isGranted('ROLE_USER') || $userId != $this->getUser()->getId()) {
                return $this->redirect($this->generateUrl('home'));
        }

        $user = new User();
        $form = $this->createForm(new Type\SettingsType(), $user);

        $user = $this->getDoctrine()
            ->getRepository('EpiAppBundle:User')
            ->find($userId);

        if ($request->isMethod('post')) {

            $form->bindRequest($request);

            if ($form->isValid()) {
                $user = $form->getData();
                $factory = $this->get('security.encoder_factory');
                $encoder = $factory->getEncoder($user);

                $user->setPassword($encoder->encodePassword($user->getPassword(), $user->getSalt()));

                $em = $this->getDoctrine()->getManager();

                $em->persist($user);
                $em->flush();
                
            }

        }

        return $this->render('EpiAppBundle:Security:acc_settings.html.twig', array('user' => $user));

    }
}