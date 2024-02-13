<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "points_prizes".
 *
 * @property int $id
 * @property string $name
 * @property int $points
 */
class PointsPrize extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'points_prizes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'points'], 'required'],
            [['points'], 'integer'],
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
            'points' => 'Points',
        ];
    }
}