<?php 


namespace GDdesign\UserBundle\EventListener;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
// for Doctrine 2.4: Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use GDdesign\UserBundle\Entity\Message;
use GDdesign\UserBundle\Entity\Reply;
use Doctrine\ORM\EntityRepository;


class MessageSubscriber implements EventSubscriber
{
	public function getSubscribedEvents()
	{
	  
		return array(
				'postPersist',
				'postUpdate',
				);
				
				
	}
	public function postUpdate(LifecycleEventArgs $args)
	{
		$this->index($args);
	}
	public function postPersist(LifecycleEventArgs $args)
	{
		$this->index($args);
	}
	public function index(LifecycleEventArgs $args)
	{
		$entity = $args->getEntity();
		$entityManager = $args->getEntityManager();

		if ($entity instanceof Reply) 
		{
		  
		   $entity->setBody($entity->getSubject());
		  
		  
		  
		   return $entity;
		    
		  // ... do something with the Product
		}
	}
}
