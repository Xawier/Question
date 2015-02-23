<?php
/**
 * AnswerController
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

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Epi\AppBundle\Form\Type;

use Epi\AppBundle\Entity\Question;
use Epi\AppBundle\Entity\Category;
use Epi\AppBundle\Entity\User;
use Epi\AppBundle\Entity\Answer;

class AnswerController extends Controller
{
    public function addAction(Request $request)
    {
        /*ROLE AUTHENTICATION*/
        if (true !== $this->get('security.context')->isGranted('ROLE_USER')) {
                return $this->redirect($this->generateUrl('register'));
        }

        $questionId = $request->get('questionId');

        $question = $this->getDoctrine()
            ->getRepository('EpiAppBundle:Question')
            ->find($questionId);

        $answer = new Answer();
        $form = $this->createForm(new Type\AnswerType(), $answer);

        if ($request->isMethod('post')) {

            $form->bindRequest($request);

            if ($form->isValid()) {
                $answer = $form->getData();
                $answer->setUser($this->getUser());
                $answer->setDate(new \DateTime());
                $answer->setQuestion($question);
                
                $em = $this->getDoctrine()->getManager();
                $em->persist($answer);
                $em->flush();

                $url = $this->generateUrl(
                    'show_question',
                    array(
                        'questionId' => $questionId)
                );
                return $this->redirect(
                    $url."#AppBundleFormTypeAnswerType_value"
                );

            }
        }

    }

    public function deleteAction(Request $request)
    {
        
        $answerId = $request->get('answerId');

        $answer = $this->getDoctrine()
            ->getRepository('EpiAppBundle:Answer')
            ->find($answerId);

        $answer->setActive(0);
        
        $em = $this->getDoctrine()->getManager();
        $em->persist($answer);
        $em->flush();

        return $this->redirect($request->headers->get('referer'));


    }

    public function restoreAction(Request $request)
    {
        $answerId = $request->get('answerId');

        $answer = $this->getDoctrine()
            ->getRepository('EpiAppBundle:Answer')
            ->find($answerId);

        $answer->setActive(1);
        
        $em = $this->getDoctrine()->getManager();
        $em->persist($answer);
        $em->flush();

        return $this->redirect($request->headers->get('referer'));


    }
}
