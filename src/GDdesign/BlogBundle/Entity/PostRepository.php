<?php
namespace GDdesign\BlogBundle\Entity;
use Doctrine\ORM\EntityRepository;

class PostRepository extends EntityRepository
{
	public function findAllOrderedByPublishedAt($page=10)
	{
		return $this->getEntityManager()
				->createQuery('SELECT p 
				               FROM GDdesignBlogBundle:Post p
				               ORDER BY p.publishedAt  DESC 
				               ')
				//->setParameter('page', $page)
				->getResult();
	}
	
	public function getAllOrderedByPublishedAt($page=10)
	{
		return $this->getEntityManager()
				->createQuery('SELECT p 
				               FROM GDdesignBlogBundle:Post p
				               ORDER BY p.publishedAt  
				               LIMIT :page')
				->setParameter('page', $page)
				->getResult();
	}
        
}