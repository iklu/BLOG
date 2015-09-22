<?php 
namespace GDdesign\UserBundle\CompositeNotifications;


/**
* The logic of message from db
*/
class Message extends Notification
{
	protected $em;
	protected $token;
	static $sender;
	protected $newMessages;
	
	public function __construct($em, $token)
	{
		$this->em=$em;
		$this->token=$token;
		
	}

	public function newNotifications()
	{		
	
		if(($this->token->getToken()->getUser()!="anon."))
		{
			$user = $this->token->getToken()->getUser()->getId();
       	        	$this->newMessages=0;
       	        	
	       	      	$messages = $this->em->getRepository('GDdesignUserBundle:Message')->findByUser($user);
	       	        if($messages)
			{			
				 for($i=0; $i<count($messages); $i++)
        			{
        				$j=0;
					foreach ($messages[$i]->getMessages() as $message)
					{
	       					$j++;
	       					
	       					
						if($message->getLive()==true && $messages[$i]->getReceiver()->getId()==$user && $this->sameSender()!=$messages[$i]->getSender()->getId())
						{
							$this->setSender($messages[$i]->getSender()->getId());						
							$this->newMessages +=1;
						}
					}
				}
			}
				
        	 } 
		return $this->newMessages;
	}
	
	public function setSender($sender)
        {
        	self::$sender=$sender;
        }
        public function sameSender()
        {
        	return self::$sender;
        }
}
