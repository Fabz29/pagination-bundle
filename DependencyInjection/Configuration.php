<?php

namespace Fabz29\PaginationBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/configuration.html}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('fabz29_breadcrumb');

        $treeBuilder->getRootNode()->

        children()->
        scalarNode("template")->defaultValue("Fabz29PaginationBundle::Pagination/render.html.twig")->end()->
        end();

        return $treeBuilder;
    }
}
