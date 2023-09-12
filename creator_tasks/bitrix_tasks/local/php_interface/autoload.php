<?php

use Bitrix\Main\Loader;

//Автозагрузка наших классов
Loader::registerAutoLoadClasses(null, [
    'СUserBonus' => APP_CLASS_FOLDER . 'Catalog/СUserBonus.php',
]);