<?php
namespace GDdesign\UserBundle\EventListener;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Cookie;

class RequestListener implements EventSubscriberInterface
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
	 * Master request
	 */
	public function onKernelRequest(GetResponseEvent $event )
	{
		//pot sa pun sa vad daca cineva a accessat app_dev.php
		if(!$event->isMasterRequest())
		{
		//	echo "<br><span style='color:red';>He he no puedes juagarte por aquy</span>!!";
			return;
				
		} 
		
		
		$request = $event->getRequest();
		$locale = $request->getSession()->get("_locale");		
		$locale1 = $request->attributes->get('_locale');
		
		
		
		if(isset($locale1)&& $locale1 != 1)
		{
			$request->attributes->set('_locale', $locale1);
		
		}
		elseif(isset($locale))
		{
			$request->attributes->set('_locale', $locale);		
			
		}
		
        
				
	    
	}
	
	public static function getSubscribedEvents()
	{
		return array(
				// must be registered before the default Locale listener
				KernelEvents::REQUEST => array(array('onKernelRequest', 17)),
		);
	}
}