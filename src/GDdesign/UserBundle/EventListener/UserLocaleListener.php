<?php
namespace GDdesign\UserBundle\EventListener;

use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * Stores the locale of the user in the session after the
 * login. This can be used by the LocaleListener afterwards.
 */
class UserLocaleListener
{
    /**
     * @var em
     */
    private $em;
    
    /**
     * 
     * @var unknown
     */
    private $router;

    public function __construct(UrlGeneratorInterface $router)
    {        
        $this->router = $router;
    }

    /**
     * @param InteractiveLoginEvent $event
     */
    public function onInteractiveLogin(InteractiveLoginEvent $event)
    {
    	//gets the last locale variable from Database
    	$user = $event->getAuthenticationToken()->getUser();
    	$request = $event->getRequest();
      
      
     	//sets the "_locale" query parameter for translator, and locale session	
     	if (null !== $user->getLocale()) 
     	{    
     
	     	$request->getSession()->set('_locale', $user->getLocale());
	     	//$this->router->getContext()->setParameter('_locale', $user->getLocale());
	     	$this->router->getContext()->setParameters(array('_locale'=>$user->getLocale(), '_format'=>'html'));
	     	
        } 
    }
}
