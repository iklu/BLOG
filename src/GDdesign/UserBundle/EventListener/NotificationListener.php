<?php
namespace GDdesign\UserBundle\EventListener;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\HttpKernel;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Doctrine\ORM\EntityManager;
use GDdesign\UserBundle\CompositeNotifications\Notifications;
use GDdesign\UserBundle\CompositeNotifications\Message;
use GDdesign\UserBundle\CompositeNotifications\NotificationScript;




class NotificationListener
{	
	protected $container;
	protected $token;
	static $defaultLocale='en';
	
	
	    protected $em;
	    function __construct(EntityManager $em, TokenStorageInterface $token)
	    {
	        $this->em = $em;
	        $this->token = $token;
	    }
	    
	    public function onKernelRequest(GetResponseEvent $event )
	    {
	    	//pot sa pun sa vad daca cineva a accessat app_dev.php
	    	if(!$event->isMasterRequest())
	    	{
	    		echo "<br><span style='color:red';>He he no puedes juagarte por aquy</span>!!";
	    		return;
	    
	    	}
	    }
	
		/**
		* New notifications listener
		*/
        public function onKernelController(FilterControllerEvent $event)
       {    
       		if(null!==$this->token->getToken())
       		{
	       		$notifications = new Notifications();		
			    $notifications->addNotification(new Message($this->em, $this->token));
		        $newMessages =  $notifications->newNotifications();
		        if($newMessages >0)
		        {
		          	$session = $event->getRequest()->getSession();
		          	$session->set('newMessages', $newMessages);
		        }
       		}
	        
	        $controller = $event->getController();
        }  
}
