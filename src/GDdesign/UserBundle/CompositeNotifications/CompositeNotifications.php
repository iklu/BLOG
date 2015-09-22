<?php 
namespace GDdesign\UserBundle\CompositeNotifications;

abstract class CompositeNotifications extends Notification
{
	protected $notifications = array();

	public function getComposite()
	{
		return $this;
	}

	public function addNotification(Notification $notification)
	{
		if(in_array($notification, $this->notifications, true))
		{
			
			return;
		}
		$this->notifications[] = $notification;	
	}

	public function removeNotification(Notification $notification)
	{
		$this->notifications = array_udiff($this->notifications, array($notification), function($a, $b){ return ($a === $b)?0:1;});		
	}
}
