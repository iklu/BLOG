<?php

namespace GDdesign\UserBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use GDdesign\UserBundle\Entity\User;
use GDdesign\UserBundle\Form\Type\UserType;
use GDdesign\UserBundle\Form\Type\ProfileFormType;
use Symfony\Component\HttpFoundation\Response;
use GDdesign\UserBundle\GDdesignUserBundleEvents;
use GDdesign\UserBundle\Event\RequestEvent;

/**
 * UserRegister controller.
 *
 */
class AjaxController extends Controller
{
   
    /**
     * Verify if user exists bootstrap validation
     *
     */
    public function verifyUserAction(Request $request)
    {       
    	if($request->isXmlHttpRequest())
    	{	
    		$username =	$request->query->get('username');    		
    		$email = $request->query->get('email');
    		
    		$dispatcher = $this->get('event_dispatcher');
    		
    		$em = $this->getDoctrine()->getManager();
    		$er = $this->getDoctrine()->getRepository('GDdesignUserBundle:User');
    		$event = new RequestEvent($request ,$er, $em);
    		$dispatcher->dispatch(GDdesignUserBundleEvents::VERIFY_IF_USER_EXISTS, $event);
           
    		if (null !== $event->getResponse()) 
    		{    		
    			return $event->getResponse();
    		}
            

            $user = array('user' => array( array(                                    
        						   'username' => $username , 
        						   'firstname'=> $email,
        						   )));
	  	
	  	 $response = new Response(json_encode($user));
         $response->headers->set('Content-Type', 'application/json');
	  	 return $response;
    	}
    	else 
    	{
    		return $this->redirect('/blog/web/app_dev.php/admin/#read-all-users');
    	}
        
    }

   

    /**
     * Finds and displays a User entity.
     *
     */
    public function showAction($id, Request $request)
    {
        $locale = $request->getLocale();
        $em = $this->getDoctrine()->getManager();
    

        $entity = $em->getRepository('GDdesignUserBundle:User')->find($id);
        
        $user = array('user' => array( array(
                                       	   'id'=> $entity->getId(),
        						   'username' => $entity->getUsername() , 
        						   'firstname'=>$entity->getFirstname(),
        						   'email' => $entity->getEmail(),
        						   'lastname'=> $entity->getLastname(),
        						   'password'=> $entity->getPassword(),
        						   'telefon'=> $entity->getTelefon(),)));
      if($request->isXmlHttpRequest())
	  {
       	    $response = new Response(json_encode($user));
        	$response->headers->set('Content-Type', 'application/json');
	  		return $response;
	  }	
       $response = new Response("hola");
       return $response;
    }
 

   
    /**
     * Edits an existing UserRegister entity.
     *
     */
    public function updateAction(Request $request)
    {
        if($request->isXmlHttpRequest())
	  {
        	$em = $this->getDoctrine()->getManager();
        	$entity = $em->getRepository('GDdesignUserBundle:User')->find($request->query->get('id'));
            $username =	$request->query->get('username');
        	$firstname = $request->query->get('firstname');
        	$email = $request->query->get('email');
        	$lastname = $request->query->get('lastname');
        	
        	$entity->setUsername($username);
        	$entity->setLastname($lastname);
        	$entity->setFirstname($firstname);
        	$entity->setEmail($email);
	  	    $em->flush();
	 
	 
	      $userModified = $em->getRepository('GDdesignUserBundle:User')->find($request->query->get('id'));
        
          $user = array('user' => array( array(
                                       	   'id'=> $userModified->getId(),
		        						   'username' => $userModified->getUsername() , 
		        						   'firstname'=>$userModified->getFirstname(),
		        						   'email' => $userModified->getEmail(),
		        						   'lastname'=> $userModified->getLastname(),
		        						   'password'=> $userModified->getPassword(),
		        						   'telefon'=> $userModified->getTelefon(),)));
	  	
	  	 $response = new Response(json_encode($user));
         $response->headers->set('Content-Type', 'application/json');
	  	 return $response;
	  	
	  	
         }
         else
         {
         	$response = new Response("hola");
            return $response;
         }  
	  
	 // $encoded = $encoder->encodePassword($entity, $plainPassword);
       // $entity->setPassword($encoded);
		  
           

    }
    /**
     * Deletes a UserRegister entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $locale = $request->getLocale();
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('GDdesignUserBundle:User')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find UserRegister entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin'));
    }

    /**
     * Creates a form to delete a UserRegister entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
    
}
