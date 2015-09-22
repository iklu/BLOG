<?php
namespace GDdesign\UserBundle\CompositeNotifications;

class NotificationScript
{
	static function joinExistingNotifications(Notification $newNotification, Notification$occupyingNotification)
	{
		$comp;
		if(!is_null($comp = $occupyingNotification->getComposite()))
		{
			$comp = new Army();
			$comp->addNotification($occupyingNotification);
			$comp->addNotification($newNotification);
		}
		return $comp;

	}
}
