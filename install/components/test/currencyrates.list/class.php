<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;
use Bitrix\Main\UI\PageNavigation;
use Test\Currencyrates\CurrencyRateTable;

class CurrencyRatesListComponent extends CBitrixComponent
{
    public function onPrepareComponentParams($params)
    {
        $params['FILTER_NAME'] = preg_replace('/[^A-Za-z0-9_]/', '', $params['FILTER_NAME'] ?: 'arCurrencyFilter');
        $params['COLUMNS'] = (is_array($params['COLUMNS']) && !empty($params['COLUMNS']))
            ? $params['COLUMNS']
            : ['ID','CODE','DATE','COURSE'];
        $params['PAGE_SIZE'] = max(1, (int)($params['PAGE_SIZE'] ?? 20));
        $params['SORT_BY'] = in_array($params['SORT_BY'], ['ID','CODE','DATE','COURSE'], true)
            ? $params['SORT_BY']
            : 'DATE';
        $params['SORT_ORDER'] = strtoupper($params['SORT_ORDER'] ?? 'DESC');
        return $params;
    }

    protected function getNavId()
    {
        return $this->arParams['NAV_ID'] ?: ('cr_nav_'.md5(serialize($this->arParams)));
    }

    public function executeComponent()
    {
        if (!Loader::includeModule('test.currencyrates')) {
            ShowError('Модуль test.currencyrates не установлен');
            return;
        }

        $filter = [];
        if (isset($GLOBALS[$this->arParams['FILTER_NAME']]) && is_array($GLOBALS[$this->arParams['FILTER_NAME']])) {
            $filter = $GLOBALS[$this->arParams['FILTER_NAME']];
        }

        $nav = new PageNavigation($this->getNavId());
        $nav->allowAllRecords(false)
            ->setPageSize($this->arParams['PAGE_SIZE'])
            ->initFromUri();

        $query = CurrencyRateTable::query()
            ->setSelect($this->arParams['COLUMNS'])
            ->setFilter($filter)
            ->setOrder([$this->arParams['SORT_BY'] => $this->arParams['SORT_ORDER']])
            ->setOffset($nav->getOffset())
            ->setLimit($nav->getLimit());
            

        $result = $query->exec();
        $items = $result->fetchAll();

        $total = CurrencyRateTable::getCount($filter);
        $nav->setRecordCount($total);

        $this->arResult['COLUMNS'] = $this->arParams['COLUMNS'];
        $this->arResult['ITEMS']   = $items;
        $this->arResult['NAV']     = $nav;

        $this->includeComponentTemplate();
    }
}
