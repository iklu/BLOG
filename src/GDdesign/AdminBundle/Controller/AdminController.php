<?php

namespace GDdesign\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends Controller
{
    public function indexAction($page)
    {
        if($page=='adminHome')
        {
             return $this->render('GDdesignAdminBundle:Admin:home.html.twig', array('message' => 'homepage'));
        }
        else
        {
			
            return $this->render('GDdesignAdminBundle:Admin:notFound.html.twig', array('message' => 'Page not found'));
        }    
    }
    
    public function translateAction(Request $request)
    {
    	
    	$translated = $this->get('translator')->trans('Symfony2 is great');
    	return new Response($translated.$request->getLocale());
    }
    
    public function menuItemsAction()
    {
    	return $this->render('GDdesignAdminBundle::adminTemplate.html.twig', array('page' => $page));
    }
    
    
}
