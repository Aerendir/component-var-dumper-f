<?php

use Symfony\Component\VarDumper\VarDumper;

if (!function_exists('dump_to_html')) {
    function dump_to_html($file, ...$moreVars)
    {
        VarDumper::dump($var);

        foreach ($moreVars as $v) {
            VarDumper::dump($v);
        }

        if (1 < func_num_args()) {
            return func_get_args();
        }

        return $var;
    }
}

if (!function_exists('dd_to_html')) {
    function dd_to_html($file, ...$vars)
    {
        $output = fopen('1_factory_method_nothing_annotated.html', 'r+b');
        $cloner = new VarCloner();
        $dumper = new HtmlDumper();
        foreach ($vars as $v) {
            $dumper->dump($cloner->cloneVar($var), $output, [
                // 1 and 160 are the default values for these options
                'maxDepth' => 5,
                'maxStringLength' => 160
            ]);
        }

        die(1);
    }
}
