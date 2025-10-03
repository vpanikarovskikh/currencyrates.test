<?php
$arComponentParameters = [
    'PARAMETERS' => [
        'FILTER_NAME' => [
            'PARENT' => 'DATA_SOURCE',
            'NAME' => 'Имя массива фильтра',
            'TYPE' => 'STRING',
            'DEFAULT' => 'arCurrencyFilter',
        ],
        'FORM_METHOD' => [
            'PARENT' => 'BASE',
            'NAME' => 'Метод отправки',
            'TYPE' => 'LIST',
            'VALUES' => ['GET' => 'GET', 'POST' => 'POST'],
            'DEFAULT' => 'GET',
        ],
    ],
];
