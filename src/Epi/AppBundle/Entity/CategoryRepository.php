<?php

namespace Epi\AppBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * Repository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CategoryRepository extends EntityRepository
{
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

	public function getCategories(){
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

	public function getCategoryQuestions($categoryId){
		
		return $query = $this->getEntityManager()
		    ->createQuery(
			    'SELECT p
			    FROM EpiAppBundle:Question p
			    WHERE p.category = :categoryId AND p.active = 1'
			)->setParameter('categoryId', $categoryId)
 			->getResult();
        
	}

	public function countCategories()
	{
		return $query = $this->getEntityManager()
		    ->createQuery(
			    'SELECT COUNT(p)
			    FROM EpiAppBundle:Category p'
			)->getSingleScalarResult();
	}
}
