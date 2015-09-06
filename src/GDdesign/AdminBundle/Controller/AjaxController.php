<?php
namespace GDdesign\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AjaxController extends Controller
{
	public function calendarAction()
	{
		return $this->render('GDdesignAdminBundle:Ajax:calendar.html.twig');
	}
	
	public function chartsAction($charts)
	{
		return $this->render('GDdesignAdminBundle:Ajax:'.$charts.'.html.twig');
	}
	
	public function dashboardAction()
	{
		return $this->render('GDdesignAdminBundle:Ajax:dashboard.html.twig');
	}
	
	public function formsAction($forms)
	{
		return $this->render('GDdesignAdminBundle:Ajax:'.$forms.'.html.twig');
	}
	
	public function pagesAction($page)
	{
		return $this->render('GDdesignAdminBundle:Ajax:'.$page.'.html.twig');
	}
	
	public function UIAction($ui)
	{
		return $this->render('GDdesignAdminBundle:Ajax:'.$ui.'.html.twig');
	}
	
	public function tablesAction($table)
	{
		return $this->render('GDdesignAdminBundle:Ajax:'.$table.'.html.twig');
	}
	
	public function typografyAction($typografy)
	{
		return $this->render('GDdesignAdminBundle:Ajax:'.$typografy.'.html.twig');
	}
	
	public function galleryAction($gallery)
	{
		return $this->render('GDdesignAdminBundle:Ajax:'.$gallery.'.html.twig');
	}
}

?>
