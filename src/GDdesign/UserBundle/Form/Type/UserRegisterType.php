<?php
namespace GDdesign\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
class UserRegisterType extends AbstractType
{
		public function buildForm(FormBuilderInterface $builder, array $options)
		{
				$builder->add('email', 'email');
				$builder->add('username');
				$builder->add('password', 'repeated', array('first_name' => 'password', 'second_name' => 'confirm', 'type'=> 'password',));
				$builder->add('firstname');
				$builder->add('lastname');
				$builder->add('telefon', 'text');
				$builder->add('Register', 'submit');
	  }
		public function setDefaultOptions(OptionsResolverInterface $resolver)
		{
				$resolver->setDefaults(array(
						'data_class' => 'GDdesign\UserBundle\Entity\UserRegister'
				));
		}
		public function getName()
		{
					return '';
		}
}
