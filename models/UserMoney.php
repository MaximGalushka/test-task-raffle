<?php

namespace app\models;

use yii\db\ActiveRecord;

class UserMoney extends ActiveRecord
{

    const IN_PROCESS = 0;
    const TRANSFERRED = 1;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_money'; // Название таблицы в базе данных для хранения денежных средств пользователя
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'amount', 'transfer_status'], 'required'],
            [['user_id', 'amount', 'transfer_status'], 'integer'],
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
            'amount' => 'Amount',
            'transfer_status' => 'Transfer Status',
        ];
    }

    /**
     * Устанавливает статус трансфера как "В процессе".
     */
    public function setTransferStatusInProcess()
    {
        $this->updateAttributes(['transfer_status' => self::IN_PROCESS]);
    }

    /**
     * Устанавливает статус трансфера как "Переведено".
     */
    public function setTransferStatusTransferred()
    {
        $this->updateAttributes(['transfer_status' => self::TRANSFERRED]);
    }

    /**
     * Проверяет, находится ли статус трансфера в процессе.
     * @return bool
     */
    public function isTransferStatusInProcess()
    {
        return $this->transferStatus === self::IN_PROCESS;
    }

    /**
     * Проверяет, был ли трансфер переведен.
     * @return bool
     */
    public function isTransferStatusTransferred()
    {
        return $this->transferStatus === self::TRANSFERRED;
    }

}