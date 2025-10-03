# Модуль Bitrix: test.currencyrates

## Назначение
Модуль предназначен для хранения и отображения курсов валют.

---

## Функции
- Создание таблицы `test_currencyrates` при установке и ее удаление при деинсталляции модуля.
- Компоненты:
  - `test:currencyrates.filter` — форма фильтрации по коду валюты, дате (от/до) и курсу (от/до).
  - `test:currencyrates.list` — вывод списка курсов валют с поддержкой:
    - фильтрации,
    - сортировки,,
    - постраничной навигации.
- Автоматическая установка/удаление компонентов при установке/удалении модуля.

---

## Установка
Скопировать папку `test.currencyrates` в `bitrix/modules/`.

2. В административной панели Битрикс перейти в Модули, найти модуль `test.currencyrates`, нажать Установить.

При установке будет создана таблица `test_currencyrates` и скопированы компоненты в `/local/components/test/`.

---

## Использование

### Страница с фильтром и списком
Пример `currencyrates.php` (добавить в корень сайта):

```php
<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Курсы валют");

$APPLICATION->IncludeComponent('test:currencyrates.filter', '', [
    'FILTER_NAME' => 'arCurrencyFilter',
]);

$APPLICATION->IncludeComponent('test:currencyrates.list', '', [
    'FILTER_NAME' => 'arCurrencyFilter',
    'COLUMNS'     => ['ID','CODE','DATE','COURSE'],
    'PAGE_SIZE'   => 10,
    'SORT_BY'     => 'DATE',
    'SORT_ORDER'  => 'DESC',
]);

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
