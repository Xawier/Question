<?php
/**
 * UserRepository
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
 * Class UserRepository
 * @package Epi\AppBundle\Entity
 */
class UserRepository extends EntityRepository
{
    /**
     * @return mixed
     */
    public function countUsers()
    {
        return $query = $this->getEntityManager()
            ->createQuery(
                'SELECT COUNT(p)
			    FROM EpiAppBundle:User p'
            )->getSingleScalarResult();
    }
}
