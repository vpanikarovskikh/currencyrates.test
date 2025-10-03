<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>
<form method="get">
    <label>
        Код валюты (USD/EUR):
        <input type="text" name="code" value="<?=htmlspecialcharsbx($arResult['VALUES']['code'])?>">
    </label>
    <br>

    <label>
        Дата от:
        <input type="date" name="date_from" value="<?=htmlspecialcharsbx($arResult['VALUES']['date_from'])?>">
    </label>
    <label>
        до:
        <input type="date" name="date_to" value="<?=htmlspecialcharsbx($arResult['VALUES']['date_to'])?>">
    </label>
    <br>

    <label>
        Курс от:
        <input type="number" step="0.0001" name="rate_from" value="<?=htmlspecialcharsbx($arResult['VALUES']['rate_from'])?>">
    </label>
    <label>
        до:
        <input type="number" step="0.0001" name="rate_to" value="<?=htmlspecialcharsbx($arResult['VALUES']['rate_to'])?>">
    </label>
    <br>

    <button type="submit">Фильтровать</button>
</form>
