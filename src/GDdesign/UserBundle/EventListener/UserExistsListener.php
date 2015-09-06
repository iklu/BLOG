<?php
namespace GDdesign\UserBundle\EventListener;
use GDdesign\UserBundle\GDdesignUserBundleEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use GDdesign\UserBundle\Event\RequestEvent;
use Symfony\Component\HttpFoundation\Response;


/**
 * Listener responsible for checking  if user exists for json response
 */
class UserExistsListener implements EventSubscriberInterface
{
	/**
	* subscribes events
	*/	
    public static function getSubscribedEvents()
    {
        return array(
            GDdesignUserBundleEvents::VERIFY_IF_USER_EXISTS=> 'verifyIfUserExistsAjax',
        );
    }

    public function verifyIfUserExistsAjax(RequestEvent $event)
    {
    	
    	$username = $event->getRequest()->query->get('username');
    	$email = $event->getRequest()->query->get('email');
    	
    	
    	$er = $event->getEntityRepository();
    	
        $find['username'] =  $er->findOneByUsername($username);
        $find['email'] =  $er->findOneByEmail($email);
        
        
        
       if($find['email'] && $find['username'])
       {
       	  return $event->setResponse(array('username_and_email_allready_exists'=>(array(array('email'=>$email, 'username'=>$username)))));
       	   
       }
       if($find['username'])
       {
       	  return  $event->setResponse(array('username_allready_exists'=>(array(array('username'=>$username)))));
       }
       if($find['email'])
       {
       	  return   $event->setResponse(array('email_allready_exists'=>(array(array('email'=>$email)))));
       } 
    }
}

?>