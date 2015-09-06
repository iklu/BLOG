<?php

namespace GDdesign\UserBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('g_ddesign_user');
         $rootNode
        	->beforeNormalization()
        	->ifTrue(function($v)
        	 {
        		// $v contains the raw configuration values
        		return !isset($v['enabled_services']) || false === $v['enabled_services'];
       		 })
        	->then(function($v) 
        	{
        		unset($v['users']);
        		return $v;
            })
        ->end()
            ->children()
            	->booleanNode('enabled_services')->end()
            	->scalarNode('default_user')
            		->isRequired()
            		->cannotBeEmpty()
            	->end()
            	->arrayNode('users')
            		->requiresAtLeastOneElement()
            		->prototype('array')
            			->children()
            				->scalarNode('full_name')
            					->isRequired(true)
            				->end()
            				->booleanNode('is_active')
            					->defaultValue(true)
            				->end()
            			->end()
            		->end()
            	->end()
            ->end()
        ;

        
        // Here you should define the parameters that are allowed to
        // configure your bundle. See the documentation linked above for
        // more information on that topic.

        return $treeBuilder;
    }
}
