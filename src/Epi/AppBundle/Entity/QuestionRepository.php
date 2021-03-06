<?php
/**
 * AnswerType
 *
 * PHP version 5.3.3
 *
 * @category EntityRepository
 * @package  Epi\AppBundle
 * @author   Mateusz Haber <mateusz.haber@uj.edu.pl>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://wierzba.wzks.uj.edu.pl/~11_haber/Question/
 */
namespace Epi\AppBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * Questionrepository
 *
 * @category Repository
 * @package  Epi\AppBundle\Entity
 * @author   Mateusz Haber <mateusz.haber@uj.edu.pl>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://wierzba.wzks.uj.edu.pl/~11_haber/Question/
 */
class QuestionRepository extends EntityRepository
{
    /**
     * GetQuestionAnswers
     *
     * @param int $questionId questionId
     *
     * @return array
     */
    public function getQuestionAnswers($questionId)
    {
        return $query = $this->getEntityManager()
            ->createQuery(
                'SELECT p
			    FROM EpiAppBundle:Answer p
			    WHERE p.question = :questionId AND p.active = 1'
            )->setParameter('questionId', $questionId)
            ->getResult();
    }

    /**
     * IsAuthor
     *
     * @param Epi\AppBundle\Entity\Question $question question
     * @param Epi\AppBundle\Entity\User     $user     user
     *
     * @return bool
     */
    public function isAuthor($question,$user)
    {
        if (isset($user)) {
            if (true == $user->getRoles('ROLE_USER') && isset($question)) {
                if ($user->getId() == $question->getUser()->getId()
                    || true == $user->getRoles('ROLE_ADMIN')
                ) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * CountQuestions
     *
     * @return mixed
     */
    public function countQuestions()
    {
        return $query = $this->getEntityManager()
            ->createQuery(
                'SELECT COUNT(p)
			    FROM EpiAppBundle:Question p'
            )->getSingleScalarResult();
    }

    /**
     * GetAd
     *
     * @param int $question question
     *
     * @return mixed
     */
    public function getAd($question)
    {
        $number = rand(1, 100);

        if ($number > 0 and $number <= 30) {
            $userId = 13;
        } else if ($number > 30 and $number <= 40) {
            $userId = $question->getUser()->getId();
        } else if ($number > 40 and $number <= 100) {
            if ($question->getBestAnswer()) {
                $userId = $question->getBestAnswer()->getUser()->getId();
            } else {
                $userId = 13;
            }
        }

        $query = $this->getEntityManager()
            ->createQuery(
                'SELECT p.ad
			    FROM EpiAppBundle:User p
			    WHERE p.id = :userId'
            )->setParameter('userId', $userId)
            ->getSingleScalarResult();

        if ($query == null) {
            $userId = 13;

            $query = $this->getEntityManager()
                ->createQuery(
                    'SELECT p.ad
			    FROM EpiAppBundle:User p
			    WHERE p.id = :userId'
                )->setParameter('userId', $userId)
                ->getSingleScalarResult();
        }

        return $query;
    }
}
