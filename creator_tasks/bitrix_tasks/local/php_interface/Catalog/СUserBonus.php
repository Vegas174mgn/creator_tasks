<?php

use Bitrix\Main\Loader;
use Bitrix\Sale\Order;

class СUserBonus
{
    public static function SetBonusForOrder($orderID, $arFields)
    {
        $minPrice = 5000;
        Loader::includeModule("sale");
        if ($arFields == 'F') {
            $order = Order::load($orderID);
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
}