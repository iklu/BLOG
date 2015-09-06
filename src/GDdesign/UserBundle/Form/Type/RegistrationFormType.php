<?php
namespace GDdesign\UserBundle\Form\Type;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\True;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // add your custom field
        	$builder->add('firstname');
		    $builder->add('lastname');
		    $builder->add('telefon', 'text');
		    $builder->add('terms', 'checkbox', array('property_path' => 'termsAccepted'));
    }

    public function getParent()
    {
        return 'fos_user_registration';
    }

    public function getName()
    {
        return 'gddesign_user_registration';
    }
}