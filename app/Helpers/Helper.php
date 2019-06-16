<?php


//Вторник, Ноември 6, 2018
if (!function_exists('change_format')) {
    function change_format($number) {
        $result = $number;

        if ($result == 0) {
            return '0';
        }
        if (!empty($_COOKIE['odd']) && $_COOKIE['odd'] == 'american') {
            $result = ($number - 1) * 100;
        }

        return $result;
    }
}
