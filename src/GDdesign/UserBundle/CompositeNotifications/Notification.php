<?php 
namespace GDdesign\UserBundle\CompositeNotifications;

abstract class Notification
{
	public function getComposite()
	{
		return null;
	}

	abstract function  newNotifications();
}
