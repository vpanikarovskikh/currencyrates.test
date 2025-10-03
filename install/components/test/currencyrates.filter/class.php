<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Context;

class CurrencyRatesFilterComponent extends CBitrixComponent
{
    public function onPrepareComponentParams($params)
    {
        $params['FILTER_NAME'] = preg_replace('/[^A-Za-z0-9_]/', '', $params['FILTER_NAME'] ?: 'arCurrencyFilter');
        $params['FORM_METHOD'] = ($params['FORM_METHOD'] === 'POST') ? 'POST' : 'GET';
        return $params;
    }

    public function executeComponent()
    {
        $request = Context::getCurrent()->getRequest();

        // читаем значения из GET/POST
        $code     = strtoupper(trim((string)$request->get('code')));
        $dateFrom = (string)$request->get('date_from'); // YYYY-MM-DD
        $dateTo   = (string)$request->get('date_to');
        $rateFrom = (string)$request->get('rate_from');
        $rateTo   = (string)$request->get('rate_to');

        $filter = [];

        // код валюты
        if ($code !== '') {
            $filter['=CODE'] = $code;
        }

        // даты
        if ($dateFrom) {
            $filter['>=DATE'] = new \Bitrix\Main\Type\DateTime($dateFrom.' 00:00:00', 'Y-m-d H:i:s');
        }
        if ($dateTo) {
            $filter['<=DATE'] = new \Bitrix\Main\Type\DateTime($dateTo.' 23:59:59', 'Y-m-d H:i:s');
        }

        // курс
        if ($rateFrom !== '') {
            $filter['>=COURSE'] = (float)$rateFrom;
        }
        if ($rateTo !== '') {
            $filter['<=COURSE'] = (float)$rateTo;
        }

        // сохраняем в глобальный фильтр
        $GLOBALS[$this->arParams['FILTER_NAME']] = $filter;

        // передадим текущие значения в шаблон формы
        $this->arResult['VALUES'] = [
            'code'      => $code,
            'date_from' => $dateFrom,
            'date_to'   => $dateTo,
            'rate_from' => $rateFrom,
            'rate_to'   => $rateTo,
        ];

        $this->includeComponentTemplate();
    }
}
