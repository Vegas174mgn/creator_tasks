<?php

use Bitrix\Main\EventManager;
$eventManager = EventManager::getInstance();

//Вешаем обработчик на событие создания списка пользовательских свойств
$eventManager->addEventHandler(
    'sale',
    'OnSaleStatusOrder',
    [
        'СUserBonus',
        'SetBonusForOrder'
    ]
);