<?php

namespace GDdesign\UserBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

class UserRepository extends EntityRepository
{
	public function findByAllContacts($limit)
	{
		$dql = "SELECT p FROM GDdesignUserBundle:User p ";
	    $query =  $this->getEntityManager()
		->createQuery($dql)	
		->setFirstResult(0)
		->setMaxResults(10000);
	    
		return $paginator = new Paginator($query, $fetchJoinCollection = true);
		 $c = count($paginator);
		 
		 
	}
	public function findIfUsernameExists($username)
	{
		return $this->getEntityManager()
		->createQuery('SELECT p FROM GDdesignUserBundle:User p WHERE p.username LIKE :username')
		->setParameter('username', $username)
		->setFirstResult(0)
		->setMaxResults(2)
		->getResult();
	}
	public function findIfEmailExists($email)
	{
		return $this->getEntityManager()
		->createQuery('SELECT p FROM GDdesignUserBundle:User p WHERE p.email LIKE :email')
		->setParameter('email', $email)
		->setFirstResult(0)
		->setMaxResults(2)
		->getResult();
	}
}

?>