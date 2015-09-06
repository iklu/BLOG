<?php

namespace GDdesign\UserBundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;


use Symfony\Component\HttpKernel\Bundle\Bundle;

class GDdesignUserBundle extends Bundle
{
	 public function getParent()
    {
        return 'FOSUserBundle';
    }
}
