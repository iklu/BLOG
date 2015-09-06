<?php
namespace GDdesign\UserBundle\Form\Model;

use Symfony\Component\Validator\Constraints as Assert;
use GDdesign\UserBundle\Entity\UserRegister;
class Registration
{
	/**
	* @Assert\Type(type="GDdesign\UserBundle\Entity\UserRegister")
	* @Assert\Valid()
	*/
	protected $user;
	/**
	* @Assert\NotBlank()
	* @Assert\True()
	*/
	protected $termsAccepted;
	public function setUser(UserRegister $user)
	{
		$this->user = $user;
	}
	public function getUser()
	{
		return $this->user;
	}
	public function getTermsAccepted()
	{
		return $this->termsAccepted;
	}
	public function setTermsAccepted($termsAccepted)
	{
		$this->termsAccepted = (Boolean) $termsAccepted;
	}
}
