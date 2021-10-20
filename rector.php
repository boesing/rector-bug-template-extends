<?php
declare(strict_types=1);

use Rector\Core\Configuration\Option;
use Rector\Set\ValueObject\LevelSetList;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    // it means support syntax up to php 7.4
    $containerConfigurator->import(LevelSetList::UP_TO_PHP_74);

    $parameters = $containerConfigurator->parameters();
    $parameters->set(Option::SKIP, [
        \Rector\Php71\Rector\FuncCall\CountOnNullRector::class,

        // opiniated
        \Rector\Php74\Rector\Property\RestoreDefaultNullToNullableTypePropertyRector::class,
    ]);

    $services = $containerConfigurator->services();

    $services->set(\Rector\Php74\Rector\Property\TypedPropertyRector::class)
        ->call('configure', [[
            \Rector\Php74\Rector\Property\TypedPropertyRector::PRIVATE_PROPERTY_ONLY => true,
        ]]);
};

