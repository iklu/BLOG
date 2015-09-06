<?php

namespace GDdesign\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use FOS\UserBundle\Controller\ProfileController as FOSProfileController;

class ProfileController extends FOSProfileController
{
   public function showAction(Request $request)
   {
	   
	   	$response = parent::showAction($request);

        // ... do custom stuff

        return $response;
   }
   
   /**
     * Edit the user
     */
    public function editAction(Request $request)
    {
		$response = parent::editAction($request);

        // ... do custom stuff

        return $response;
	}
	
	public function manageAccountAction()	
	{
		$userAccount = $this->get('security.context')->getToken()->getUser()->getId();
		$deleteForm = $this->createDeleteForm($userAccount);
		
		return $this->render('GDdesignUserBundle:Profile:manage.html.twig', array(				
				'delete_form' => $deleteForm->createView(),		
		));
	}
	
	/**
	 * Deletes a User entity.
	 *
	 */
	public function deleteAccountAction(Request $request)
	{
		$userAccount = $this->get('security.context')->getToken()->getUser()->getId();
		$form = $this->createDeleteForm($userAccount);
		$form->handleRequest($request);
	
		if ($form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$entity = $em->getRepository('GDdesignUserBundle:User')->find($userAccount);
	
			if (!$entity) {
				throw $this->createNotFoundException('Unable to find User entity.');
			}
	
			$em->remove($entity);
			$em->flush();
			return $this->redirect($this->generateUrl('g_ddesign_page_homepage'));
		}
		return $this->render('GDdesignUserBundle:Profile:manage.html.twig', array(
				'delete_form' => $form->createView(),
		));
		
	}
	
	/**
	 * Creates a form to delete a User entity by id.
	 *
	 * @param mixed $id The entity id
	 *
	 * @return \Symfony\Component\Form\Form The form
	 */
	private function createDeleteForm($id)
	{
		return $this->createFormBuilder()
		->setAction($this->generateUrl('delete_account', array('id' => $id)))
		->setMethod('DELETE')
		->add('submit', 'submit', array('label' => 'Delete'))
		->getForm()
		;
	}

}
