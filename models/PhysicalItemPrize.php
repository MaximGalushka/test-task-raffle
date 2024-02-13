<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "physical_item_prizes".
 *
 * @property int $id
 * @property string $name
 * @property int $in_stock
 */
class PhysicalItemPrize extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'physical_item_prizes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'in_stock'], 'required'],
            [['in_stock'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'in_stock' => 'In Stock',
        ];
    }


    /**
     * @return bool
     */
    public function increment()
    {
        return $this->updateCounters(['in_stock' => 1]);
    }

    /**
     * @return bool
     */
    public function decrement()
    {
        return $this->updateCounters(['in_stock' => -1]);
    }

    public static function getPrizeByName($prizeName)
    {
        return static::findOne(['name' => $prizeName]);
    }
}