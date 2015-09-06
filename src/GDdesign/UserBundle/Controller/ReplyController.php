<?php

namespace GDdesign\UserBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use GDdesign\UserBundle\Entity\Reply;
use GDdesign\UserBundle\Form\MessageType;
use GDdesign\UserBundle\Entity\User;
use GDdesign\UserBundle\Entity\Message;
use GDdesign\UserBundle\GDdesignUserBundleEvents;
use FOS\UserBundle\Event\FormEvent;
/**
 * Reply controller.
 *
 */
class ReplyController extends Controller
{
    public function contactsAction(Request $request)
    {
        $locale = $request->getLocale();
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('GDdesignUserBundle:User')->findByAllContacts(10);
      
      
           return $this->render('GDdesignUserBundle:Reply:contacts.html.twig', array('entities' => $entities));
    }
    /**
     * Lists all Reply entities.
     *
     */
    public function inboxAction($page)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser()->getId();
        $em = $this->getDoctrine()->getManager();
        $messages = $em->getRepository('GDdesignUserBundle:Message')->findByUser($user);
        
        for($i=0; $i<count($messages); $i++)
        {
        	$j=0;
			foreach ($messages[$i]->getMessages() as $message)
			{
	       		$j++;
				if($message->getLive()==true)
				{
					$receiver[$messages[$i]->getReceiver()->getId()][$i] = $messages[$i]->getReceiver()->getUsername()."<br>";
			    	$msg['subject'][$i][$j] = $message->getSubject();
			    	$msg['receiver'][$i] = $messages[$i]->getReceiver()->getUsername();
					$msg['id'][$i] = $messages[$i]->getReceiver()->getId();
					$msg['true'][$i] = $message->getLive();
					$msg['sender'][$i] = $messages[$i]->getSender()->getUsername();
					$msg['time'][$i] = $this->get('app.diff')->ago($message->getCreated());
					$msg['message_id'][$i] = $messages[$i]->getId();
				}  
			}
	  		$msg['last_subj'][$i] = $msg['subject'][$i][$j];	
        }
       if(isset($msg))
       {
       		$count=count($messages);
       }
       else 
       {
       		$msg=array();
       		$count=count($msg);
       }
      

        return $this->render('GDdesignUserBundle:Reply:index.html.twig', array(
            'entities' => $messages,    
            'message'  => $msg, 
            'count'=>$count,
        ));
    }
    /**
     * Creates a new Reply entity.
     *
     */
    public function createAction(Request $request)
    {
    
        //get service containers
        $sender = $this->get('security.token_storage')->getToken()->getUser()->getId();
        $dispatcher = $this->get('event_dispatcher');
        
        
        $reply = new Reply();
        
        $form = $this->createCreateForm($reply, $reply->getUser());
        $form->handleRequest($request);
        
        $em = $this->getDoctrine()->getManager();
        $conversation = $em->getRepository('GDdesignUserBundle:Message')->findByConversation($sender, $reply->getUser());
       
	   
       if(!$conversation)
       {
            	$receiver = $em->getRepository('GDdesignUserBundle:User')->find($reply->getUser());
        	$sender = $em->getRepository('GDdesignUserBundle:User')->find($sender);
        	$receiver = $em->getRepository('GDdesignUserBundle:User')->find($reply->getUser());
		if(!$receiver)
		{
			throw $this->createNotFoundException('El usuario no existe!');
		}
        	$message = new Message();
            	$message->setSender($sender);
           	$message->setReceiver($receiver);
            	$reply->setMessage($message);
            	$reply->setUser($sender->getUsername());
        } 
       else
        {
	      $id =  $conversation[0]->getId();
            $sender = $em->getRepository('GDdesignUserBundle:User')->find($sender);
            $receiver = $em->getRepository('GDdesignUserBundle:User')->find($reply->getUser());
	      if(!$receiver)
	     {
				throw $this->createNotFoundException('El usuario no existe !');
	     }
            $conversation = $em->getRepository('GDdesignUserBundle:Message')->find($id);
            $message = $reply->setMessage($conversation);  
            $conversation->setSender($sender);
            $conversation->setReceiver($receiver);
            $reply->setUser($sender->getUsername());
        }	

        if ($form->isValid()) {
        
            $event = new FormEvent($form, $request);
            $em = $this->getDoctrine()->getManager();
            $em->persist($reply);
            $em->persist($message);
            $em->flush();
            
            $dispatcher->dispatch(GDdesignUserBundleEvents::SEND_MESSAGE_REPLY, $event);

           // return $this->redirect($this->generateUrl('message_reply_new', array('user' => $receiver->getId())));
            
            return $this->render('GDdesignUserBundle:Reply:new.html.twig', array(
            'entity' => $reply,
            'form'   => $form->createView(),
        ));
        }

        return $this->render('GDdesignUserBundle:Reply:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Reply entity.
     *
     * @param Reply $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Reply $entity, $user)
    {
        $tokenStorage = $this->container->get('security.token_storage');
        $form = $this->createForm(new MessageType($tokenStorage, $user), $entity, array(
            'action' => $this->generateUrl('message_reply_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Reply entity.
     *
     */
    public function newAction($user)
    {
        $entity = new Reply();
        $form   = $this->createCreateForm($entity, $user);

        return $this->render('GDdesignUserBundle:Reply:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Reply entity.
     *
     */
    public function showAction(Request $request,$id)
    {  
        $limit= 10 ;     
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('GDdesignUserBundle:Message')->find($id);
        if($entity)
        {
        	$user[] = $entity->getSender()->getId();
        	$user[] = $entity->getReceiver()->getId();
        	$identify = $this->get('security.token_storage')->getToken()->getUser()->getId();
   	  	if(in_array($identify , $user))
   	  	{
       	 	if($identify != $entity->getReceiver()->getId())
        		{
        			$user=$entity->getReceiver()->getId();
        		}
       	 	else
        		{
        			$user=$entity->getSender()->getId();
        		}
        		$reply = new Reply();
        		$form   = $this->createCreateForm($reply, $user);	
        		$deleteForm = $this->createDeleteForm($id);
        		 return $this->render('GDdesignUserBundle:Reply:show.html.twig', array(
            					'entities'      => $entity,
          						 'delete_form' => $deleteForm->createView(),
            					'id'=>$id,
            					'form'   => $form->createView(),
        						));
        	}
        	else
        	{
        		$entity=null;
        		$request->getSession()->getFlashBag()->add('notice', 'You dont have personal messages!');
        		return $this->render('GDdesignUserBundle:Reply:flash.html.twig', array(
            					));
        	}
        }
        $request->getSession()->getFlashBag()->add('notice', 'No messages found!');
        return $this->render('GDdesignUserBundle:Reply:flash.html.twig', array(
            					));
       	

       
    }

    /**
     * Displays a form to edit an existing Reply entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GDdesignUserBundle:Reply')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Reply entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('GDdesignUserBundle:Reply:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Reply entity.
    *
    * @param Reply $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Reply $entity)
    {
        $form = $this->createForm(new ReplyType(), $entity, array(
            'action' => $this->generateUrl('message_reply_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Reply entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GDdesignUserBundle:Reply')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Reply entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('message_reply_edit', array('id' => $id)));
        }

        return $this->render('GDdesignUserBundle:Reply:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Reply entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('GDdesignUserBundle:Reply')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Reply entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('message_reply'));
    }

    /**
     * Creates a form to delete a Reply entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('message_reply_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
    
     /**
     * Lists all Message entities.
     *
     */
    public function outboxAction()
    {
    	$em = $this->getDoctrine()->getManager();
    	$user = $this->get('security.token_storage')->getToken()->getUser()->getUsername();
    
    	$now = new \DateTime();
    	$ref = new \DateTime("2014-07-30 05:56:40");
    	$diff = $now->diff($ref);
    	printf('%d years,  %d months,  %d days, %d hours, %d minutes',$diff->y, $diff->m, $diff->d, $diff->h, $diff->i);
    
    	//finds the message from personal session
    	$entities = $em->getRepository('GDdesignUserBundle:Message')->findBySender($user);
    
    	return $this->render('GDdesignUserBundle:Message:outbox.html.twig', array(
    			'entities' => $entities,
    			'diff'=>$diff,
    	));
    }
	
 public function deleteCheckedMessagesAction(Request $request)
    {
    	$deleteMessages = $request->request->get('message_id');
		if($deleteMessages)
		{
			foreach($deleteMessages  as $deleteMessageId) {
					$em = $this->getDoctrine()->getManager();
					$entity = $em->getRepository('GDdesignUserBundle:Message')->find($deleteMessageId);
    
					if (!$entity) 
					{
						throw $this->createNotFoundException('Unable to find Message entity.');
					}
    
					$em->remove($entity);
					$em->flush();
    		
			}
		}
    	return $this->redirect($this->generateUrl('message_reply'));
    }
}
