<?php

namespace GDdesign\UserBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use GDdesign\UserBundle\Entity\Message;
use GDdesign\UserBundle\Form\MessageType;

/**
 * Message controller.
 *
 */
class MessageController extends Controller
{

    /**
     * Lists all Message entities.
     *
     */
    public function inboxAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->get('security.token_storage')->getToken()->getUser()->getId();
        
        $now = new \DateTime();
        $ref = new \DateTime("2014-07-30 05:56:40");
        $diff = $now->diff($ref);
        printf('%d years,  %d months,  %d days, %d hours, %d minutes',$diff->y, $diff->m, $diff->d, $diff->h, $diff->i);
                
        //finds the message from personal session
        $entities = $em->getRepository('GDdesignUserBundle:Message')->findByUser($user);

        return $this->render('GDdesignUserBundle:Message:index.html.twig', array(
            'entities' => $entities,
            'diff'=>$diff,		
        ));
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
    /**
     * Creates a new Message entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Message();
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            //puts the sender name
            $entity->setSender($user);
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('message_show', array('id' => $entity->getId())));
        }

        return $this->render('GDdesignUserBundle:Message:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Message entity.
     *
     * @param Message $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Message $entity)
    {
    	$tokenStorage = $this->container->get('security.token_storage');
    	//give access to form messages
        $form = $this->createForm(new MessageType($tokenStorage), $entity, array(
            'action' => $this->generateUrl('message_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Message entity.
     *
     */
    public function newAction()
    {
        $entity = new Message();
        $form   = $this->createCreateForm($entity);

        return $this->render('GDdesignUserBundle:Message:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Message entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GDdesignUserBundle:Message')->find($id);
        

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Message entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('GDdesignUserBundle:Message:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Message entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GDdesignUserBundle:Message')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Message entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('GDdesignUserBundle:Message:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Message entity.
    *
    * @param Message $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Message $entity)
    {
    	$tokenStorage = $this->container->get('security.token_storage');
        $form = $this->createForm(new MessageType($tokenStorage), $entity, array(
            'action' => $this->generateUrl('message_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Message entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GDdesignUserBundle:Message')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Message entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('message_edit', array('id' => $id)));
        }

        return $this->render('GDdesignUserBundle:Message:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Message entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('GDdesignUserBundle:Message')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Message entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('message'));
    }
    
    public function deleteCheckedMessagesAction(Request $request)
    {
    	$deleteMessages = $request->request->get('message_id');
    	foreach($deleteMessages  as $deleteMessageId) {
    			$em = $this->getDoctrine()->getManager();
    			$entity = $em->getRepository('GDdesignUserBundle:Message')->find($deleteMessageId);
    
    			if (!$entity) {
    				throw $this->createNotFoundException('Unable to find Message entity.');
    			}
    
    			$em->remove($entity);
    			$em->flush();
    		
    	}
    	return $this->redirect($this->generateUrl('message'));
    }

    /**
     * Creates a form to delete a Message entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('message_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
    
    
}
