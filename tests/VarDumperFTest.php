<?php

declare(strict_types=1);

/*
 * This file is part of the Serendipity HQ VarDumper F Component.
 *
 * Copyright (c) Adamo Aerendir Crespi <aerendir@serendipityhq.com>.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SerendipityHQ\Component\VarDumperToHtml\Tests;

use PHPUnit\Framework\TestCase;

final class VarDumperFTest extends TestCase
{
    public function testDumpfWritesEveryVariableToTheSameHtmlFileAndReturnsThem(): void
    {
        $workingDirectory = \getcwd();
        self::assertIsString($workingDirectory);

        $outputDirectory = \sys_get_temp_dir() . '/component-var-dumper-f-' . \bin2hex(\random_bytes(8));
        self::assertTrue(\mkdir($outputDirectory));
        \chdir($outputDirectory);

        try {
            self::assertSame('first-dumped-value', dumpf('first-dumped-value'));
            self::assertSame(['second-dumped-value', 'third-dumped-value'], dumpf('second-dumped-value', 'third-dumped-value'));

            $dumpFiles = \glob($outputDirectory . '/*.html');
            self::assertIsArray($dumpFiles);
            self::assertCount(1, $dumpFiles);

            $dump = \file_get_contents($dumpFiles[0]);
            self::assertIsString($dump);
            self::assertStringContainsString('first-dumped-value', $dump);
            self::assertStringContainsString('second-dumped-value', $dump);
            self::assertStringContainsString('third-dumped-value', $dump);
        } finally {
            \chdir($workingDirectory);
            $leftoverFiles = \glob($outputDirectory . '/*');
            if (\is_array($leftoverFiles)) {
                \array_map('unlink', $leftoverFiles);
            }
            \rmdir($outputDirectory);
        }
    }
}
