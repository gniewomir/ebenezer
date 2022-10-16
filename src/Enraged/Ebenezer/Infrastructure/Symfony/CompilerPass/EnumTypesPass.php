<?php

declare(strict_types=1);

namespace Enraged\Ebenezer\Infrastructure\Symfony\CompilerPass;

use InvalidArgumentException;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class EnumTypesPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container): void
    {
        $typesDefinition = [];
        if ($container->hasParameter('doctrine.dbal.connection_factory.types')) {
            $typesDefinition = $container->getParameter('doctrine.dbal.connection_factory.types');
        }
        if (!\is_array($typesDefinition)) {
            throw new InvalidArgumentException('Types definition has to be an array!');
        }
        $taggedEnums = array_keys($container->findTaggedServiceIds('ebenezer.doctrine_enum_type'));

        foreach ($taggedEnums as $enumType) {
            $typesDefinition[(string) $enumType::NAME] = ['class' => $enumType];
        }
        $container->setParameter('doctrine.dbal.connection_factory.types', $typesDefinition);
    }
}
