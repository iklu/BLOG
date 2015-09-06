<?php
namespace GDdesign\BlogBundle\Utils;
/**
*The blog application needs a utility that can transform a post title (e.g. "Hello World") into a slug (e.g."hello-world").
*/
class Slugger
{

	public function slugify($string)
	{
		return preg_replace('/[^a-z0-9]/', '-', strtolower(trim(strip_tags($string))));
	}
}
