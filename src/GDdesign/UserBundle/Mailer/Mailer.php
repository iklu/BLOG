<?php
namespace GDdesign\UserBundle\Mailer;

class Mailer
{
private $transport;
	public function __construct($transport)
	{
		$this->transport=$transport;
	}
	public function getTransport()
	{
		return $this->transport;
	}
// ...
}

?>