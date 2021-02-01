<?php

declare(strict_types = 1);

/*
 * This file is part of the Serendipity HQ Aws Ses Bundle.
 *
 * Copyright (c) Adamo Aerendir Crespi <aerendir@serendipityhq.com>.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Rector\Core\Configuration\Option;
use Rector\Core\ValueObject\PhpVersion;
use Rector\Set\ValueObject\SetList;

return static function (ContainerConfigurator $containerConfigurator) : void {
    $parameters = $containerConfigurator->parameters();

    $parameters->set(Option::PHP_VERSION_FEATURES, PhpVersion::PHP_73);

    $parameters->set(Option::PATHS, [
        __DIR__ . '/src',
        __DIR__ . '/tests'
    ]);

    $parameters->set(Option::AUTOLOAD_PATHS, [__DIR__ . '/vendor-bin/phpunit/vendor/autoload.php']);

    $parameters->set(
        Option::SETS,
        [
            SetList::ARRAY_STR_FUNCTIONS_TO_STATIC_CALL,
            SetList::CODE_QUALITY,
            SetList::CODING_STYLE,
            // SetList::NAMING, // Do not use in this library
            // SetList::ORDER, // Do not use in this library
            SetList::PHP_52,
            SetList::PHP_53,
            SetList::PHP_54,
            SetList::PHP_56,
            SetList::PHP_70,
            SetList::PHP_71,
            SetList::PHP_72,
            SetList::PHP_73,
            SetList::PHPUNIT_40,
            SetList::PHPUNIT_50,
            SetList::PHPUNIT_60,
            SetList::PHPUNIT_70,
            SetList::PHPUNIT_75,
            SetList::PHPUNIT_80,
            SetList::PHPUNIT80_DMS,
            SetList::PHPUNIT_CODE_QUALITY,
            SetList::PHPUNIT_EXCEPTION,
            SetList::PHPUNIT_MOCK,
            SetList::PHPUNIT_SPECIFIC_METHOD,
            SetList::PHPUNIT_YIELD_DATA_PROVIDER,
            SetList::UNWRAP_COMPAT,
            SetList::SYMFONY_CODE_QUALITY,
            SetList::SAFE_07,
            SetList::TYPE_DECLARATION,
        ]
    );

    $parameters->set(Option::IMPORT_SHORT_CLASSES, false);

    $parameters->set(
        Option::SKIP,
        [
            __DIR__ . '/tests/bootstrap.php',
            Rector\CodeQuality\Rector\Catch_\ThrowWithPreviousExceptionRector::class,
            Rector\CodeQuality\Rector\Concat\JoinStringConcatRector::class,
            Rector\CodeQuality\Rector\Identical\SimplifyBoolIdenticalTrueRector::class,
            Rector\CodingStyle\Rector\Class_\AddArrayDefaultToArrayPropertyRector::class,
            Rector\CodingStyle\Rector\ClassMethod\NewlineBeforeNewAssignSetRector::class,
            Rector\CodingStyle\Rector\ClassMethod\RemoveDoubleUnderscoreInMethodNameRector::class,
            Rector\CodingStyle\Rector\Encapsed\EncapsedStringsToSprintfRector::class,
            Rector\CodingStyle\Rector\Switch_\BinarySwitchToIfElseRector::class,
            Rector\CodingStyle\Rector\Throw_\AnnotateThrowablesRector::class,
            Rector\CodingStyle\Rector\Use_\RemoveUnusedAliasRector::class,
            Rector\Php56\Rector\FunctionLike\AddDefaultValueForUndefinedVariableRector::class, // Maybe good one day
            Rector\PHPUnit\Rector\Class_\AddSeeTestAnnotationRector::class,
            Rector\PHPUnit\Rector\ClassMethod\AddDoesNotPerformAssertionToNonAssertingTestRector::class,
            Rector\TypeDeclaration\Rector\ClassMethod\AddArrayParamDocTypeRector::class,
            Rector\TypeDeclaration\Rector\ClassMethod\AddArrayReturnDocTypeRector::class,
        ]
    );
};
