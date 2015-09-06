<?php

namespace GDdesign\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Form\Extension\Core\ChoiceList\ChoiceList;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Doctrine\ORM\EntityRepository;

class MessageType extends AbstractType
{
	private $tokenStorage;
	
	public function __construct(TokenStorageInterface $tokenStorage, $user)
	{
		$this->tokenStorage = $tokenStorage;
		$this->user=$user;
	}
	
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            
            ->add('subject')
            ->add('body' , 'textarea', array('attr' => array('class' => 'tinymce', 'data-theme' => 'bbcode' )
											));
       		 // grab the user, do a quick sanity check that one exists
        	$user = $this->tokenStorage->getToken()->getUser()->getRoles();
        	if (!$user) 
        	{
        		throw new \LogicException('The FriendMessageFormType cannot be used without an authenticated user!');
            }
            if(!in_array('ROLE_ADMIN', $user))
            {
            	
        	    $builder->addEventListener(
        		FormEvents::PRE_SET_DATA,
        		function (FormEvent $event) use ($user) {
        		$form = $event->getForm();
        
        		$formOptions = array(
        			'class' => 'GDdesign\UserBundle\Entity\User',
        			'query_builder' => function (EntityRepository $er) use ($user) {
        			// build a custom query
        			// return $er->createQueryBuilder('u')->addOrderBy('fullName', 'DESC');
        
        			// or call a method on your repository that returns the query builder
        			// the $er is an instance of your UserRepository
        	
        			//	$er->getDistinctUsers();
					return	$er->createQueryBuilder('p')
            				   ->where('p.username = :username')
        					   ->setParameter('username', 'admin')
        					   ->orderBy('p.username', 'ASC');
        	
        
        	       },
        	  );
        	       
        	    
        	// create the field, this is similar the $builder->add()
        	// field name, field type, data, options
        	    $form->add('user', 'entity', $formOptions);
        	}
        	);
       }
       else
       {
      
          
       	     $builder->add('user' , 'hidden' , array('data'=>$this->user));
       }
       
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'GDdesign\UserBundle\Entity\Reply'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'gddesign_userbundle_message';
    }
}
