<?php

namespace app\models;

use yii\db\ActiveRecord;

class UserPoints extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_points'; // Название таблицы в базе данных для хранения баллов пользователя
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'points'], 'required'],
            [['user_id', 'points'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'points' => 'Points',
        ];
    }

}