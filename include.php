<?php
use Bitrix\Main\Loader;

// Регистрируем автозагрузку ORM-класса модуля
Loader::registerAutoLoadClasses('test.currencyrates', [
    'Test\\Currencyrates\\CurrencyRateTable' => 'lib/CurrencyRateTable.php',
]);
