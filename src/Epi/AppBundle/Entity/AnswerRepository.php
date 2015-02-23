<?php
/**
 * AnswerRepository
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
 * AnswerRepository
 *
 * @category EntityRepository
 * @package  Epi\AppBundle\Entity
 * @author   Mateusz Haber <mateusz.haber@uj.edu.pl>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://wierzba.wzks.uj.edu.pl/~11_haber/Question/
 */
class AnswerRepository extends EntityRepository
{

    /**
     * CountAnswers
     *
     * @return mixed
     */
    public function countAnswers()
    {
        return $query = $this->getEntityManager()
            ->createQuery(
                'SELECT COUNT(p)
			    FROM EpiAppBundle:Answer p'
            )->getSingleScalarResult();
    }
}
