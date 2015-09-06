<?php
namespace GDdesign\UserBundle\EventListener;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\HttpKernel;

class RequestListener
{
	public function onKernelRequest(GetResponseEvent $event)
	{     
	       //pot sa pun sa vad daca cineva a accessat app_dev.php
		if(!$event->isMasterRequest())
		{
		       echo "<br><span style='color:red';>He he no puedes juagarte por aquy</span>!!";
			return; 
		}
	}
}
