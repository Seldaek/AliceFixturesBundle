<?php

/*
 * This file is part of the h4cc/AliceFixtureBundle package.
 *
 * (c) Julius Beckmann <github@h4cc.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace h4cc\AliceFixturesBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class ProviderCompilerPass
 *
 * @author Julius Beckmann <github@h4cc.de>
 */
class ProviderCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (false === $container->hasDefinition('h4cc_alice_fixtures.manager')) {
            return;
        }

        $definition = $container->getDefinition('h4cc_alice_fixtures.manager');

        foreach (array_keys($container->findTaggedServiceIds('h4cc_alice_fixtures.provider')) as $id) {
            $definition->addMethodCall('addProvider', array(new Reference($id)));
        }
    }
}
