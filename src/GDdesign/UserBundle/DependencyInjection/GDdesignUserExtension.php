<?php

namespace GDdesign\UserBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class GDdesignUserExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);
         
        if (isset($config['enabled_services']) && $config['enabled_services']) 
        {
        	$loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
            $loader->load('services.yml');
        } 
        if($config['default_user']=='admin')
        {
        	$config = array('default_user' => 'dragoi');
        }
        if($config['default_user']=='dragoi')
        {
        	echo "this is a configuration test";
        
        	$container->get('app.diff');
        }
        
		//with this method i change the parameter from service.yml
		/**
        $container->setParameter('mailer.transport', 'receivemail');
        echo  $container->get('mailer')->getTransport();
        echo "terminate";
        */
    }
}
