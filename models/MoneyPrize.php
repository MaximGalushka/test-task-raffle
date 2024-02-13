<?php
namespace app\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "money_prizes".
 *
 * @property int $id
 * @property string $name
 * @property float $amount
 */
class MoneyPrize extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'money_prizes';
    }

    /**
     * Возвращает всегда true.
     *
     * @return bool
     */
    public static function isAvailable(): bool
    {
        return true;
    }

    // Остальной код
}