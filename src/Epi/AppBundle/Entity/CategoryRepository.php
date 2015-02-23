<?php
/**
 * CategoryRepository
 *
 * PHP version 5.3.3
 *
 * @category Repository
 * @package  Epi\AppBundle
 * @author   Mateusz Haber <mateusz.haber@uj.edu.pl>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://wierzba.wzks.uj.edu.pl/~11_haber/Question/
 */
namespace Epi\AppBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * Repository
 *
 * @category Repository
 * @package  Epi\AppBundle\Entity
 * @author   Mateusz Haber <mateusz.haber@uj.edu.pl>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://wierzba.wzks.uj.edu.pl/~11_haber/Question/
 */
class CategoryRepository extends EntityRepository
{

    /**
     * CountCategoryQuestions
     *
     * @param int $categoryId categoryId
     *
     * @return mixed
     */
    public function countCategoryQuestions($categoryId)
    {
        return $query = $this->getEntityManager()
            ->createQuery(
                'SELECT COUNT(p)
			    FROM EpiAppBundle:Question p
			    WHERE p.category = :categoryId AND p.active = 1'
            )->setParameter('categoryId', $categoryId)
            ->getSingleScalarResult();
    }

    /**
     * GetCategories
     *
     * @return array
     */
    public function getCategories()
    {
        $category = $this->getEntityManager()
            ->getRepository('EpiAppBundle:Category')
            ->findAll();

        foreach ($category as $key => $value) {
            $count = $this->getEntityManager()
                ->getRepository('EpiAppBundle:Category')
                ->countCategoryQuestions($value->getId());
            $category[$key]->count = $count;
        }

        return $category;
    }

    /**
     * GetCategoryQuestions
     *
     * @param int $categoryId categoryId
     *
     * @return array
     */
    public function getCategoryQuestions($categoryId)
    {
        return $query = $this->getEntityManager()
            ->createQuery(
                'SELECT p
			    FROM EpiAppBundle:Question p
			    WHERE p.category = :categoryId AND p.active = 1'
            )->setParameter('categoryId', $categoryId)
            ->getResult();
    }

    /**
     * CountCategories
     *
     * @return mixed
     */
    public function countCategories()
    {
        return $query = $this->getEntityManager()
            ->createQuery(
                'SELECT COUNT(p)
			    FROM EpiAppBundle:Category p'
            )->getSingleScalarResult();
    }
}
