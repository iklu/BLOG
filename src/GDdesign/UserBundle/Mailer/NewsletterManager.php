<?php
namespace GDdesign\UserBundle\Mailer;

class NewsletterManager
{
	private $mailer;
	public function __construct(\Mailer $mailer)
	{
		$this->mailer = $mailer;
	}
	public function setMailer(\Mailer $mailer)
	{
		$this->mailer = $mailer;
	}
}	

?>