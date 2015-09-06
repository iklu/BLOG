<?php
namespace GDdesign\UserBundle\Twig;

class AppExtension extends \Twig_Extension
{
	public function getFilters()
	{
		return array(
				new \Twig_SimpleFilter('row', array($this, 'priceFilter')),
				);
				}
	public function priceFilter($number, $dividor = 4, $i)
	{
		$div = $i/$dividor;
		if(is_int($div))
		{
			return "<div class='row'>".$number."</div>";
		}
		else
		{
			return "nu";
		}
					
	}
	public function getName()
	{
					return 'app_extension';
	}
							

}

?>