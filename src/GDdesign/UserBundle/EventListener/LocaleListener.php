<?php
namespace GDdesign\UserBundle\EventListener;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\DependencyInjection\ContainerInterface;



class LocaleListener 
{
   
    
   	/**
	 * 
	 * @param ContainerInterface $container
	 */
	private $container;
	
	public function __construct(ContainerInterface $container)
	{
		$this->container =  $container;
	}
	
	
    /**
     * 
     * @param FilterControllerEvent $event
     * 
     */
    public function onKernelController(FilterControllerEvent $event)
    {
     
    	
    	$request = $event->getRequest();
    	$locale = $request->attributes->get('_locale');
        if (!$request->hasPreviousSession()) {
            return;
        }
        // try to see if the locale has been set as a _locale routing parameter
        if ($request->attributes->get('_locale') && null !== $this->container->get("security.context")->getToken()) {
        	
        	if($this->container->get("security.context")->getToken()->getUser()!='anon.')
        	{
        		$userID = $this->container->get("security.context")->getToken()->getUser()->getId();
        		 
        		$em = $this->container->get('doctrine')->getManager();
        		$userLanguage = $em->getRepository('GDdesignUserBundle:User')->find($userID);
        		$language =  $userLanguage->setLocale($request->attributes->get('_locale'));
        		$em->flush();
        		 
        		
        		$request->getSession()->set('_locale', $locale);
        	}  
            
        } elseif($request->attributes->get('_locale')) {
        	
        	//aici in cazul in care am access 
        	/**
        	$userID = $this->tokenStorage->getToken()->getUser()->getID();
        	 echo "hl";
        	$userLanguage = $this->em->getRepository('GDdesignUserBundle:User')->find($userID);
        	$language =  $userLanguage->setLocale($userLanguage->getLocale());
        	$this->em->flush();
        	*/       
        	 $locale=  $request->getSession()->get('_locale');
        	   $request->getSession()->set('_locale', $locale);  
        	 
        }
        else
        {
        	
        	$request->getSession()->get("_locale");
        	$request->getSession()->set('_locale', $locale);
        	
      
        
        }	
        
 
    }
 
}


?>
