<?php

/*
 * This file is part of VarDumper CLI to HTML.
 *
 * Copyright Adamo Aerendir Crespi 2020.
 *
 * @author    Adamo Aerendir Crespi <hello@aerendir.me>
 * @copyright Copyright (C) 2020 Aerendir. All rights reserved.
 * @license   MIT
 */

use SerendipityHQ\Component\VarDumperCliToHtml\VarDumperCliToHtml;

if ( ! function_exists('dumpf')) {
    /**
     * @param mixed $var
     * @param mixed ...$moreVars
     *
     * @return mixed
     */
    function dumpf($var, ...$moreVars)
    {
        VarDumperCliToHtml::dump($var);

        foreach ($moreVars as $v) {
            VarDumperCliToHtml::dump($v);
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
            VarDumperCliToHtml::dump($var);
        }

        die(1);
    }
}
