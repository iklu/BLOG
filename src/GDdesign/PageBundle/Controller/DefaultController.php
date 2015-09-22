<?php

namespace GDdesign\PageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use GDdesign\BlogBundle\Entity\Post;
use GDdesign\UserBundle\Entity\Message;

class DefaultController extends Controller
{ 
    
	
	public function localeAction(Request $request)
	{
		 $locale = $request->getLocale();
		 return $this->render('./default/locale.html.twig', array( 'locale' => $locale));
	}
	
    public function indexAction(Request $request)
    {
        $locale = $request->getLocale();
        $selected = 'selected';
		$promotions = '';
        return $this->render('./default/index.html.twig', array('index' => $selected, 
																'locale' => $locale,
																'promotions'=> $promotions));
    }
    
    public function webDevelopmentAction(Request $request)
    {
        $locale = $request->getLocale();
        $selected = 'selected';
        return $this->render('./default/webdev.html.twig' , array('webdev' => $selected, 'locale' => $locale));
    }
    
    public function contactAction(Request $request)
    {
        $locale = $request->getLocale();
        $selected = 'selected';
        return $this->render('./default/contact.html.twig', array('contact' => $selected, 'locale' => $locale));
    }
    
    public function aboutUsAction(Request $request)
    {
        $locale = $request->getLocale();
        $selected = 'selected';
        return $this->render('./default/aboutus.html.twig', array('aboutus' => $selected, 'locale' => $locale));
    }
    
     public function newsAction($page, Request $request)
    {
        $locale = $request->getLocale();
        $selected = '';
        
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('GDdesignBlogBundle:Post')->findAllOrderedByPublishedAt($page); 
        
        
        
        return $this->render('./default/news.html.twig', array('aboutus' => $selected,
        									'entities' => $entities,
        									'locale' => $locale));
    }
    
    public function translateAction(Request $request)
    {
    	
    	$translated = $this->get('translator')->trans('Welcome to our page!', array('index' => $index, 'locale' => $locale));
    	return new Response($translated.$request->getLocale());
    	
    }
    
    public function notFoundAction(Request $request )
    {
        $locale = $request->getLocale();
       
        return $this->render('./default/notFound.html.twig', array( 'locale' => $locale));
    }
    
    public function sendMailAction(Request $request)
    {
    	$locale = $request->getLocale();
    	 $message = \Swift_Message::newInstance()
    	 ->setSubject('La pagina!')
    	->setFrom("dragoiovidiu2011@gmail.com")
    	->setTo($request->request->get('sender'))
    	->setBody(
    			 $this->render('./default/contact.html.twig', array( 'locale' => $locale))
    			,
    			'text/html'
    	)
    	->attach(\Swift_Attachment::fromPath('./files/none.png'))
    	/*
    	 * If you also want to include a plaintext version of the message
    	->addPart(
    			$this->renderView(
    					'Emails/registration.txt.twig',
    					array('name' => $name)
    			),
    			'text/plain'
    	)
    	*/
    	;
    	 $this->get('mailer')->send($message);
  
    	
    	 return $this->render('./default/contact.html.twig', array( 'locale' => $locale));
    }
    
}
