<?php

namespace GDdesign\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use GDdesign\UserBundle\Form\Type\RegistrationType;
use GDdesign\UserBundle\Entity\UserRegister;
use GDdesign\UserBundle\Form\Model\Registration;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints;
use Symfony\Component\Security\Core\SecurityContext;
use FOS\UserBundle\Controller\SecurityController as BaseController;

// these import the "@Route" and "@Template" annotations
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use FOS\UserBundle\Controller\SecurityController as LoginController;

class SecurityController extends LoginController
{
	/**
	public function loginAction(Request $request)
    {
         $locale = $request->getLocale();
        $request = $this->getRequest();
     	$session = $request->getSession();
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = $request->getSession()->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        }
		return $this->render('GDdesignUserBundle:Security:login.html.twig',
                       		 array('last_username'=>$session->get(SecurityContext::LAST_USERNAME),
                                   'error'=>$error ,
                                   'login'=>true, 
                                   'locale'=>$locale
							 ));
    }
	*/
}
