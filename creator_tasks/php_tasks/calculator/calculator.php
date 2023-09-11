<?php

function getResult(): float
{
    // int-овые значения http запросов (если они есть)
    $val1 = intval($_REQUEST["val1"] ?? 0);
    $val2 = intval($_REQUEST["val2"] ?? 0);
    $result = 0;

    if (isset($_REQUEST["operation"])) {
        $result = match ($_REQUEST["operation"]) {
            "plus" => $val1 + $val2,
            "minus" => $val1 - $val2,
            "multiply" => $val1 * $val2,
            "divide" => $val1 / $val2,
        };
    }
    return $result;
}