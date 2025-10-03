<?php
namespace Test\Currencyrates;

use Bitrix\Main\Entity;
use Bitrix\Main\Type\DateTime;

class CurrencyRateTable extends Entity\DataManager
{
    public static function getTableName()
    {
        return 'test_currencyrates';
    }

    public static function getMap()
    {
        return [
            new Entity\IntegerField('ID', [
                'primary' => true,
                'autocomplete' => true,
            ]),
            new Entity\StringField('CODE', [
                'required' => true,
                'validation' => function () {
                    return [
                        new Entity\Validator\Length(null, 3),
                        function ($value) {
                            return preg_match('/^[A-Z]{3}$/', $value)
                                ? true
                                : 'CODE must be 3 uppercase letters';
                        }
                    ];
                },
            ]),
            new Entity\DatetimeField('DATE', [
                'required' => true,
            ]),
            new Entity\FloatField('COURSE', [
                'required' => true,
            ]),
        ];
    }
}
