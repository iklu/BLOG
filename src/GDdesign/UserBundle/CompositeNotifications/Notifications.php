<?php
namespace GDdesign\UserBundle\CompositeNotifications;

class Notifications extends CompositeNotifications
{
	protected $allNotifications;
	public function newNotifications()
	{
		
		foreach($this->notifications as $notification)
		{
			$this->allNotifications += $notification->newNotifications();
		}
		return $this->allNotifications;
	 }
}

