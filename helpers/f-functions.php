<?php
include_once 'helpers/access.php';

function f_lang()
{
    saveAccess();
    if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
        preg_match('/[a-z]{2}/', $_SERVER['HTTP_ACCEPT_LANGUAGE'], $matches);
        $result = $matches[0];
        if ($result !== 'pt') {
            setcookie('lang', 'en');
            return 'en';
        } else {
            setcookie('lang', 'pt');
            return 'pt';
        }
    }
}
