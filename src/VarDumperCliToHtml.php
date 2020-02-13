<?php

declare(strict_types=1);

/*
 * This file is part of VarDumper CLI to HTML.
 *
 * Copyright Adamo Aerendir Crespi 2020.
 *
 * @author    Adamo Aerendir Crespi <hello@aerendir.me>
 * @copyright Copyright (C) 2020 Aerendir. All rights reserved.
 * @license   MIT
 */

namespace SerendipityHQ\Component\VarDumperCliToHtml;

use Symfony\Component\VarDumper\Cloner\VarCloner;
use Symfony\Component\VarDumper\Dumper\HtmlDumper;

/**
 * Creates the output in which the dump is then saved.
 */
class VarDumperCliToHtml
{
    /**
     * @param array<string,array|string>|string $options
     * @param mixed                             $var
     */
    public static function dump($options, $var): void
    {
        if (false === \in_array(\PHP_SAPI, ['cli', 'phpdbg'])) {
            throw new \LogicException('You can use DumperCliToHtml only from the command line.');
        }

        static $output = null;
        $cloner        = new VarCloner();
        $dumper        = new HtmlDumper();

        if (null === $output) {
            /** @psalm-suppress InvalidOperand */
            $file = random_int(0, mt_getrandmax()) . '.html';
            if (is_string($options)) {
                $file    = rtrim($options, '.html') . '.html';
                $options = [];
            }

            if (is_array($options) && isset($options['file'])) {
                $file = $options['file'];

                if (false === is_string($file)) {
                    throw new \InvalidArgumentException('The "file" passed with $options must be a file path as a string.');
                }

                $file = rtrim($file, '.html') . '.html';
                unset($options['file']);
            }

            $output = fopen($file, 'a+b');
        }

        if (false === is_array($options)) {
            $options = [];
        }

        if (false === is_resource($output)) {
            throw new \RuntimeException('Something went wrong creating the dump file.');
        }

        $dumper->dump($cloner->cloneVar($var), $output, $options);
    }
}
