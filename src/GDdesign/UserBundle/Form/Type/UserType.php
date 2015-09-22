<?php

namespace GDdesign\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Extension\Core\ChoiceList\ChoiceList;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class UserType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {   
         $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
	      $user = $event->getData();
              $form = $event->getForm();
              $user->getUsername();
              if(!$user || null != $user->getId()) 
              {
			  	$form->add('username', 'text', array('disabled'=>true));
			  	$form->add('password', 'password');
			  	$form->add('enabled' , 'choice', array( 'placeholder' => 'Enabled:','choices'=>array(true=>'true',false=>'false')));
			  	
	      	}
	     	 else
	      	{
	      		$form->add('username', 'text', array('disabled'=>false, ));
	      		$form->add('password', 'password');
	      		$form->add('confirmPassword', 'password');
	      	}
	   });
        
        $builder
            ->add('email')  
            ->add('firstname')
            ->add('lastname')
            ->add('telefon', 'text')
            ->add('bootstrapValidationEmail', 'hidden')
            ->add('bootstrapValidationUsername', 'hidden')
        /**    ->add('roles', 'choice', array('choice_list' => new ChoiceList(array('ROLE_ADMIN','ROLE_USER'), array('admin', 'user')),
								                         'placeholder' => 'Role:',
                                                 		 'required'=> false,
                                                  		 'empty_data' => null ))
                                                  		 */
                                                  		 
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'GDdesign\UserBundle\Entity\User'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return null;
    }
}
