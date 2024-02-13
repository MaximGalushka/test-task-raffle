<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "user_physical_items".
 *
 * @property int $id
 * @property int $user_id
 * @property string $item_name
 * @property int $delivery_status
 */
class UserPhysicalItems extends ActiveRecord
{
    const DELIVERY_STATUS_WAIT = 0;
    const DELIVERY_STATUS_PROCESS = 1;
    const DELIVERY_STATUS_DELIVERED = 2;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_physical_items';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'item_name'], 'required'],
            [['user_id', 'delivery_status'], 'integer'],
            [['item_name'], 'string', 'max' => 255],
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
            'item_name' => 'Item Name',
            'delivery_status' => 'Delivery Status',
        ];
    }

    public function setDeliveryStatusWait()
    {
        $this->updateAttributes(['delivery_status' => self::DELIVERY_STATUS_WAIT]);
    }

    public function setDeliveryStatusProcess()
    {
        $this->updateAttributes(['delivery_status' => self::DELIVERY_STATUS_PROCESS]);
    }

    public function setDeliveryStatusDelivered()
    {
        $this->updateAttributes(['delivery_status' => self::DELIVERY_STATUS_DELIVERED]);
    }

    public function isDeliveryStatusWait()
    {
        return $this->delivery_status === self::DELIVERY_STATUS_WAIT;
    }

    public function isDeliveryStatusProcess()
    {
        return $this->delivery_status === self::DELIVERY_STATUS_PROCESS;
    }

    public function isDeliveryStatusDelivered()
    {
        return $this->delivery_status === self::DELIVERY_STATUS_DELIVERED;
    }
}
