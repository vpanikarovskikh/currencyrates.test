<?php
$arAllCols = ['ID' => 'ID', 'CODE' => 'CODE', 'DATE' => 'DATE', 'COURSE' => 'COURSE'];

$arComponentParameters = [
    'PARAMETERS' => [
        'FILTER_NAME' => [
            'PARENT' => 'DATA_SOURCE',
            'NAME' => 'Имя массива фильтра',
            'TYPE' => 'STRING',
            'DEFAULT' => 'arCurrencyFilter',
        ],
        'COLUMNS' => [
            'PARENT' => 'BASE',
            'NAME' => 'Какие колонки выводить',
            'TYPE' => 'LIST',
            'VALUES' => $arAllCols,
            'MULTIPLE' => 'Y',
            'DEFAULT' => ['ID','CODE','DATE','COURSE'],
        ],
        'PAGE_SIZE' => [
            'PARENT' => 'BASE',
            'NAME' => 'Размер страницы',
            'TYPE' => 'STRING',
            'DEFAULT' => '20',
        ],
        'SORT_BY' => [
            'PARENT' => 'DATA_SOURCE',
            'NAME' => 'Сортировать по',
            'TYPE' => 'LIST',
            'VALUES' => $arAllCols,
            'DEFAULT' => 'DATE',
        ],
        'SORT_ORDER' => [
            'PARENT' => 'DATA_SOURCE',
            'NAME' => 'Порядок сортировки',
            'TYPE' => 'LIST',
            'VALUES' => ['ASC' => 'ASC', 'DESC' => 'DESC'],
            'DEFAULT' => 'DESC',
        ],
        'NAV_ID' => [
            'PARENT' => 'BASE',
            'NAME' => 'ID постраничной навигации (опционально)',
            'TYPE' => 'STRING',
            'DEFAULT' => '',
        ],
    ],
];
