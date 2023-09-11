<?php

function calculateClockAngle($hours, $minutes): float
{
    // обработка формата 24 часов
    $hours = $hours % 12;

    // Рассчитываем угол часовой стрелки
    $hourAngle = 30 * $hours + 0.5 * $minutes;

    // Рассчитываем угол минутной стрелки
    $minuteAngle = 6 * $minutes;

    // Вычисляем угол между стрелками
    $angleBetween = abs($hourAngle - $minuteAngle);

    // Убеждаемся, что угол не больше 180 градусов
    if ($angleBetween > 180) {
        $angleBetween = 360 - $angleBetween;
    }
    return $angleBetween;
}