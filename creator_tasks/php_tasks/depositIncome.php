<?php

function depositIncome($money, $days, $interest): ?float
{
    /**
    * Для расчета ставки в большинстве случаев используется 365 дней,
    * даже в високосный год
    */
    $ratioOfDays = $days / 365;
    return ($money * $interest * $ratioOfDays) / 100;
}
