<?php

namespace SilasJoisten\Sonata\Oauth2LoginBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

final class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('sonata_oauth2_login');
        $rootNode = $treeBuilder->getRootNode();

        $rootNode
            ->children()
                ->arrayNode('default_user_roles')
                    ->info('Used for user creation after success validation')
                    ->example('ROLE_SONATA_ADMIN')
                    ->scalarPrototype()->end()
                ->end()
                ->arrayNode('valid_email_domains')
                    ->info('Needed for email domain validation')
                    ->example('@example.com')
                    ->scalarPrototype()->end()
                ->end()
                ->arrayNode('custom_emails')
                    ->defaultValue([])
                    ->info('Customize Emails with specific role')
                    ->arrayPrototype()
                        ->scalarPrototype()->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
