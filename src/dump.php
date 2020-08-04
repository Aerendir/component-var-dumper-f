<?php

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
    /**
     * @param mixed $var
     * @param mixed ...$moreVars
     *
     * @return mixed
     */
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
    /**
     * @param mixed ...$vars
     */
    function ddf(...$vars): void
    {
        foreach ($vars as $var) {
            VarDumperF::dump($var);
        }

        die(1);
    }
}
