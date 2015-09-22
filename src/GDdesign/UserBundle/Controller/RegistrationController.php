<?php

namespace GDdesign\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use GDdesign\UserBundle\Form\Type\RegistrationType;
use GDdesign\UserBundle\Form\Model\Registration;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints;
use Symfony\Component\Security\Core\SecurityContext;

// these import the "@Route" and "@Template" annotations
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use FOS\UserBundle\Controller\RegistrationController as FOSRegisterController;

class RegistrationController extends FOSRegisterController
{
    public function registerAction(Request $request)
    {
       $response = parent::registerAction($request);

        // ... do custom stuff

        return $response;
    }
    
    public function confirmAction(Request $request, $token)
    {
    	$response = parent::confirmAction($request, $token);
    	 return $response;
    }
	

	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	/**
    public function accountCreatedAction($name)
    {
        return $this->render('GDdesignUserBundle:Registration:accountCreated.html.twig', array('name' => $name));
    }
    public function registerAction(Request $request)
	{	
	     $locale = $request->getLocale();
	     
		$registration = new Registration();
		$form = $this->createForm(new RegistrationType(), $registration, array('action' => $this->generateUrl('account_create' ,array( '_format'=> 'html')), ));
		return $this->render('GDdesignUserBundle:Registration:register.html.twig',array('locale'=>$locale, 'form' => $form->createView()));
    }
    public function createAction(Request $request)
	{
	    $locale = $request->getLocale();
		$em = $this->getDoctrine()->getManager();
		$form = $this->createForm(new RegistrationType(), new Registration());
		$form->handleRequest($request);
		if ($form->isValid()) 
		{
			$registration = $form->getData();
			
			
			$plainPassword = $registration->getUser()->getPassword();
			$encoder = $this->container->get('security.password_encoder');
			$encoded = $encoder->encodePassword($registration->getUser(), $plainPassword);
			
			$registration->getUser()->setPassword($encoded);
			$registration->getUser()->setRoles('ROLE_USER');
			
			$em->persist($registration->getUser());
			$em->flush();
			return $this->redirect($this->generateUrl('account_created', array('name' => 'user' , '_format'=> 'html')));
			
		}
		return $this->render('GDdesignUserBundle:Registration:register.html.twig',array('locale' => $locale, 'form' => $form->createView()));
	}
	*/
}
