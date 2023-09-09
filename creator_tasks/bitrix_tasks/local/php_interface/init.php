<?php

use Bitrix\Main\Loader;

AddEventHandler("sale", "OnSaleStatusOrder", "OrderComplete");


function OrderComplete($orderID, &$arFields)
{
    $minPrice = 5000;
    Loader::includeModule("sale");
    if ($arFields == 'F') {
        $order = \Bitrix\Sale\Order::load($orderID);
        $orderUser = $order->getUserId();
        $orderTotalPrice = $order->getPrice();
        if ($orderTotalPrice > $minPrice) {
            $bonusPercent = $orderTotalPrice * 5 / 100;
        }
        CSaleUserAccount::UpdateAccount(
            $orderUser,
            $bonusPercent,
            "RUB",
            false,
            $orderID,
            false
        );
    }
}