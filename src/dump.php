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

use SerendipityHQ\Component\VarDumperCliToHtml\VarDumperF;

if ( ! function_exists('dumpf')) {
    function dumpf($var, ...$moreVars)
    {
        VarDumperF::dump($var);

        foreach ($moreVars as $v) {
            VarDumperF::dump($v);
        }

        if (1 < func_num_args()) {
            return func_get_args();
        }

        return $var;
    }
}

if ( ! function_exists('ddf')) {
    function ddf(...$vars): void
    {
        foreach ($vars as $var) {
            VarDumperF::dump($var);
        }

        exit(1);
    }
}
