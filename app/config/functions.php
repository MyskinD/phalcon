<?php

/**
 * Simple dump function
 *
 * @param $var
 */
if (!function_exists('dump')) {
    function dump() {
        $args = func_get_args();
        if (count($args) > 1) {
            return var_dump($args);
        }

        $var = reset($args);
        print '<pre>';
        if (is_bool($var) || null === $var) {
            var_export($var);
        } else {
            print_r($var);
        }
        print '</pre>';
    }
}

/**
 * Dump and Die
 *
 * @param $var
 */
if (!function_exists('dd')) {
    function dd($var) {
        dump($var);
        die();
    }
}