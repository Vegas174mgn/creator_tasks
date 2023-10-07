<?php

require dirname(__FILE__) . '/constants.php';
require dirname(__FILE__) . '/autoload.php';
require dirname(__FILE__) . '/event_handler.php';

// обёртка для print_r() и var_dump()
function print_p($val, $name = 'Содержимое переменной', $mode = false)
{
    global $USER;
    if ($USER->IsAdmin()) {
        echo '<pre>' . (!empty($name) ? $name . ': ' : '');
        if ($mode) {
            var_dump($val);
        } else {
            print_r($val);
        }
        echo '</pre>';
    }
}