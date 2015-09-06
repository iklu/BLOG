<?php
namespace GDdesign\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use GDdesign\UserBundle\Form\Type\RegistrationType;
use GDdesign\UserBundle\Entity\UserRegister;
use GDdesign\UserBundle\Form\Model\Registration;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints;
use Symfony\Component\Security\Core\SecurityContext;
use FOS\UserBundle\Controller\ResettingController as ResetController;

class RessetingController extends ResetController
{
}

?>