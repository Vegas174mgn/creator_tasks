<?php

function getMonth($monthNumber): string
{
    $months = [
        1 => 'Января', 2 => 'Февраля', 3 => 'Марта', 4 => 'Апреля',
        5 => 'Мая', 6 => 'Июня', 7 => 'Июля', 8 => 'Августа',
        9 => 'Сентября', 10 => 'Октября', 11 => 'Ноября', 12 => 'Декабря'
    ];
    return $months[$monthNumber];
}

function dateFormatter($day, $month): string
{
    if ($day > 31 || $day < 1) {
        return "Пожалуйста введите корректный день!";
    } elseif ($month > 12 || $month < 1) {
        return "Пожалуйста введите корректный месяц!";
    } elseif ($month == 2 && $day > 29) {
        return "В феврале не может быть больше 29 дней!";
    } else {
        return $day . " " . getMonth($month);
    }
}