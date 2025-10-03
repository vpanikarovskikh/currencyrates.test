<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>

<table border="1" cellpadding="6" cellspacing="0">
    <thead>
        <tr>
            <?php foreach ($arResult['COLUMNS'] as $col): ?>
                <th><?=htmlspecialcharsbx($col)?></th>
            <?php endforeach; ?>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($arResult['ITEMS'] as $row): ?>
            <tr>
                <?php foreach ($arResult['COLUMNS'] as $col): ?>
                    <td>
                        <?php
                        $val = $row[$col] ?? '';
                        if ($col === 'DATE' && $val instanceof \Bitrix\Main\Type\DateTime) {
                            $val = $val->toString();
                        }
                        echo htmlspecialcharsbx((string)$val);
                        ?>
                    </td>
                <?php endforeach; ?>
            </tr>
        <?php endforeach; ?>

        <?php if (empty($arResult['ITEMS'])): ?>
            <tr><td colspan="<?=count($arResult['COLUMNS'])?>">Нет данных</td></tr>
        <?php endif; ?>
    </tbody>
</table>

<?php
$APPLICATION->IncludeComponent(
    'bitrix:main.pagenavigation',
    '',
    ['NAV_OBJECT' => $arResult['NAV'], 'SEF_MODE' => 'N'],
    false
);
