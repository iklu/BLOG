<?php
namespace GDdesign\UserBundle\EventListener;
use GDdesign\UserBundle\GDdesignUserBundleEvents;
use FOS\UserBundle\Event\FormEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Listener responsible for adding the default user role at registration
 */
class MessageSentListener implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return array(
            GDdesignUserBundleEvents::SEND_MESSAGE_REPLY=> 'onMessageSentSuccess',
        );
    }

	/**
	* uses FOS\UserBundle\Event\FormEvent
	*/
    public function onMessageSentSuccess(FormEvent $event)
    {
        /**
        	$message = $event->getForm()->getData();        
        	$testMessage = $message->getSubject();
        	$message->setSubject($testMessage);
        */
        
        echo "<span style='color:red';>Messaje mandado</span>!!";
    }
}
